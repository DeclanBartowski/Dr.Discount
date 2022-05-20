<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\ActionFilter\Authentication,
    Bitrix\Main\Engine\ActionFilter,
    Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Context;

CJSCore::Init(array("fx", "ajax", "jquery"));

class VplLoginComponent extends CBitrixComponent implements Controllerable
{
    private $componentPage = '';

    public function configureActions()
    {
        return [
            'auth' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }

    public function authAction($data)
    {
        global $USER;
        $arAuthResult = $USER->Login($data['LOGIN'], $data['PASSWORD'], $data['remember']);
        if ($arAuthResult === true) {
            $result = ['STATUS' => 'SUCCESS'];
        } else {
            $result = ['STATUS' => 'ERROR', 'MESSAGE' => $arAuthResult['MESSAGE']];
        }

        return $result;
    }

    public function Login()
    {
        $request = Context::getCurrent()->getRequest();
        $post = $request->getPostList()->toArray();

        if (!empty($post['LOGIN']) || !empty($post['PASSWORD'])) {
            if (strlen($post['LOGIN']) > 0) {
                if (strlen($post['PASSWORD']) > 0) {
                    $loginAct = $this->authAction($post);
                    if ($loginAct['STATUS'] == 'SUCCESS') {
                        $this->arResult['OK_MESSAGE'] = 'ОК';
                    } else {
                        $this->arResult['ERRORS'] = $loginAct['MESSAGE'];
                    }
                } else {
                    $this->arResult['ERRORS'] = GetMessage('TQ_AUTH_NOT_ENTER_PASSWORD_ERROR');
                }
            } else {
                $this->arResult['ERRORS'] = GetMessage('TQ_AUTH_NOT_NEED_LOGIN_ERROR');
            }
        }
    }

    public function executeComponent()
    {
        $this->Login();
        $this->includeComponentTemplate($this->componentPage);
    }

}
