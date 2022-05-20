<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="aside">
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "sidebar",
        Array(
            'FAVORITE' => count($_SESSION['FAVORITE']),
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(0=>"",),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "personal_menu",
            "USE_EXT" => "N"
        )
    );?>
</div>