<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Context,
    Bitrix\Main\Engine\Contract\Controllerable;

CJSCore::Init(array("fx", "ajax","jquery"));

class TwoQuickForgotPasswordComponent extends \CBitrixComponent implements Controllerable
{
    private $componentPage = '';

    public function configureActions()
    {
        return [
            'restorePassword' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public static function SendPassword($LOGIN, $EMAIL, $SITE_ID = false)
    {
        /** @global CMain $APPLICATION */
        global $DB, $APPLICATION;

        $arParams = array(
            "LOGIN" => $LOGIN,
            "EMAIL" => $EMAIL,
            "SITE_ID" => $SITE_ID
        );


        $result_message = array("MESSAGE"=>GetMessage('ACCOUNT_INFO_SENT')."<br>", "TYPE"=>"OK");
        $APPLICATION->ResetException();
        $bOk = true;
        foreach(GetModuleEvents("main", "OnBeforeUserSendPassword", true) as $arEvent)
        {
            if(ExecuteModuleEventEx($arEvent, array(&$arParams))===false)
            {
                if($err = $APPLICATION->GetException())
                    $result_message = array("MESSAGE"=>$err->GetString()."<br>", "TYPE"=>"ERROR");

                $bOk = false;
                break;
            }
        }

        if($bOk)
        {
            $f = false;
            if($arParams["LOGIN"] <> '' || $arParams["EMAIL"] <> '')
            {
                $confirmation = (COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y");

                $strSql = "";
                if($arParams["LOGIN"] <> '')
                {
                    $strSql =
                        "SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME ".
                        "FROM b_user u ".
                        "WHERE LOGIN='".$DB->ForSQL($arParams["LOGIN"])."' ".
                        "	AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE='')) ".
                        "	AND (EXTERNAL_AUTH_ID IS NULL OR EXTERNAL_AUTH_ID='') ";
                }
                if($arParams["EMAIL"] <> '')
                {
                    if($strSql <> '')
                    {
                        $strSql .= "\nUNION\n";
                    }
                    $strSql .=
                        "SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME ".
                        "FROM b_user u ".
                        "WHERE EMAIL='".$DB->ForSQL($arParams["EMAIL"])."' ".
                        "	AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE='')) ".
                        "	AND (EXTERNAL_AUTH_ID IS NULL OR EXTERNAL_AUTH_ID='') ";
                }
                $res = $DB->Query($strSql);

                while($arUser = $res->Fetch())
                {
                    if($arParams["SITE_ID"]===false)
                    {
                        if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
                            $arParams["SITE_ID"] = CSite::GetDefSite($arUser["LID"]);
                        else
                            $arParams["SITE_ID"] = SITE_ID;
                    }


                    if($arUser["ACTIVE"] == "Y")
                    {
                        CUser::SendUserInfo(
                            $arUser["ID"],
                            $arParams["SITE_ID"],
                            GetMessage("INFO_REQ"),
                            true,
                            'USER_PASS_REQUEST'
                        );
                        $f = true;
                    }
                    elseif($confirmation)
                    {
                        //unconfirmed registration - resend confirmation email
                        $arFields = array(
                            "USER_ID" => $arUser["ID"],
                            "LOGIN" => $arUser["LOGIN"],
                            "EMAIL" => $arUser["EMAIL"],
                            "NAME" => $arUser["NAME"],
                            "LAST_NAME" => $arUser["LAST_NAME"],
                            "CONFIRM_CODE" => $arUser["CONFIRM_CODE"],
                            "USER_IP" => $_SERVER["REMOTE_ADDR"],
                            "USER_HOST" => @gethostbyaddr($_SERVER["REMOTE_ADDR"]),
                        );

                        $event = new CEvent;
                        $event->SendImmediate("NEW_USER_CONFIRM", $arParams["SITE_ID"], $arFields);

                        $result_message = array("MESSAGE"=>GetMessage("MAIN_SEND_PASS_CONFIRM")."<br>", "TYPE"=>"OK");
                        $f = true;
                    }

                    if(COption::GetOptionString("main", "event_log_password_request", "N") === "Y")
                    {
                        CEventLog::Log("SECURITY", "USER_INFO", "main", $arUser["ID"]);
                    }
                }
            }
            if(!$f)
            {
                return array("MESSAGE"=>GetMessage('DATA_NOT_FOUND')."<br>", "TYPE"=>"ERROR");
            }
        }
        return $result_message;
    }

    public function restorePasswordAction()
    {
        $result = [];
        $request = Context::getCurrent()->getRequest();
        $post = $request->getPostList()->toArray();
        $this->arResult['ERROR'] = [];
        if ($post['email']) {
            $filter = ['=EMAIL' => $post['email']];
            $obUser = \Bitrix\Main\UserTable::getList([
                'select' => ['ID', 'NAME', 'EMAIL','LOGIN'],
                'filter' => $filter,
            ]);
            $User = $obUser->fetch();
            $arResult = $this->SendPassword($User['LOGIN'], $User['EMAIL']);
            if ($arResult['TYPE'] != 'OK') {
                $this->arResult['ERROR'] = "Пользователь не найден";
                $result = ['STATUS' => 'ERROR','MESSAGE'=>$this->arResult['ERROR']];
            } else {
                $this->arResult['OK_MESSAGE'] = $arResult['MESSAGE'];
                $result = ['STATUS' => 'SUCCESS','MESSAGE' => $arResult['MESSAGE']];
            }
        }
        return $result;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate($this->componentPage);

    }

}
