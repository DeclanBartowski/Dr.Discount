<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Context;

CJSCore::Init(array("fx", "ajax", "jquery"));

class VplRegistrationComponent extends \CBitrixComponent implements Controllerable
{
    private $componentPage = '';

    /**
     * @return array[][]
     */
    public function configureActions()
    {
        return [
            'register' => [ // Ajax-метод
                'prefilters' => [],
            ],
            'getCaptcha' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @return array|string[]
     */
    public function registerAction()
    {
        global $USER;
        $request = Context::getCurrent()->getRequest();

        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $password_confirm = $request->getPost('password_confirm');
        $name = $request->getPost('name');
        $phone = $request->getPost('phone');
        $note = $request->getPost('note');

        $captcha_code = $request->getPost('captcha_sid');
        $captcha_word = $request->getPost('captcha_word');

        if ($captchaError = $this->checkCaptcha($captcha_code, $captcha_word)) {
            $result = ['STATUS' => 'ERROR', 'MESSAGE' => $captchaError];
            $this->arResult['ERRORS'] = $captchaError;
        } else {
            $arRegisterResult = $USER->Register($email, $name, '', $password, $password_confirm, $email);
            if ($arRegisterResult['TYPE'] == 'OK') {
                $result = ['STATUS' => 'SUCCESS'];
                $user = new \CUser;
                $fields = array(
                    "PERSONAL_PHONE" => $phone,
                    "PERSONAL_NOTES" => $note
                );
                $user->Update($arRegisterResult['ID'], $fields);
                $this->arResult['OK_MESSAGE'] = $arRegisterResult['MESSAGE'];
            } else {
                $result = ['STATUS' => 'ERROR', 'MESSAGE' => $arRegisterResult['MESSAGE']];
                $this->arResult['ERRORS'] = $arRegisterResult['MESSAGE'];
            }
        }

        return $result;
    }

    /**
     * @param $captcha_code
     * @param $captcha_word
     * @return false|string
     */
    private function checkCaptcha($captcha_code, $captcha_word)
    {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");
        $cpt = new CCaptcha();
        $captchaPass = COption::GetOptionString("main", "captcha_password", "");
        if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0) {
            if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass)) {
                return GetMessage("MF_CAPTCHA_WRONG");
            }
        } else {
            return GetMessage("MF_CAPTHCA_EMPTY");
        }
        return false;
    }

    /**
     * @return void
     */
    private function getCaptcha()
    {
        global $APPLICATION;
        $this->arResult["capCode"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
    }

    public function getCaptchaAction(){
        $this->getCaptcha();
        return $this->arResult["capCode"];
    }

    /**
     * @return mixed|void|null
     */
    public function executeComponent()
    {
        $this->getCaptcha();
        $this->includeComponentTemplate($this->componentPage);
    }

}
