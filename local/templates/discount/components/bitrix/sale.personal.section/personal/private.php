<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y' && $arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams["MAIN_CHAIN_NAME"] <> '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_PRIVATE"));
if ($arParams['SET_TITLE'] == 'Y')
{
	$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_PRIVATE"));
}

if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y')
{
	        LocalRedirect('/');
}
else
{

    ?>
    <div class="account">
        <div class="account__content">
            <?
                require_once __DIR__ . '/sidebar.php';
            ?>
            
            <div class="account__main">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.profile",
                        "",
                        Array(
                            "SET_TITLE" =>$arParams["SET_TITLE"],
                            "AJAX_MODE" => $arParams['AJAX_MODE_PRIVATE'],
                            "SEND_INFO" => $arParams["SEND_INFO_PRIVATE"],
                            "CHECK_RIGHTS" => $arParams['CHECK_RIGHTS_PRIVATE'],
                            "EDITABLE_EXTERNAL_AUTH_ID" => $arParams['EDITABLE_EXTERNAL_AUTH_ID'],
                            "DISABLE_SOCSERV_AUTH" => $arParams['DISABLE_SOCSERV_AUTH']
                        ),
                        $component
                    );

                    ?>
            </div>
        </div>
    </div>

    <?php
}
