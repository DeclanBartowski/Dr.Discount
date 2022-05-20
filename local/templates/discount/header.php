<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Page\Asset;

$page = $APPLICATION->GetCurPage(false);
?>
	<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
	<head>
        <?php $APPLICATION->ShowHead(); ?>
        <?php
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="180x180" href="' . SITE_TEMPLATE_PATH . '/img/favicon/apple-touch-icon.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="32x32" href="' . SITE_TEMPLATE_PATH . '/img/favicon/favicon-32x32.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="16x16" href="' . SITE_TEMPLATE_PATH . '/img/favicon/favicon-16x16.png">');
        Asset::getInstance()->addString('<link rel="manifest" href="' . SITE_TEMPLATE_PATH . '/img/favicon/site.webmanifest">');
        Asset::getInstance()->addString('<link rel="mask-icon" href="' . SITE_TEMPLATE_PATH . '/img/favicon/safari-pinned-tab.svg" color="#5bbad5">');
        Asset::getInstance()->addString('<meta name="msapplication-TileColor" content="#e4f0f5">');
        Asset::getInstance()->addString('<meta name="theme-color" content="#e4f0f5">');
        Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.googleapis.com">');
        Asset::getInstance()->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>');
        Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">');
        Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>');

        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/nouislider.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.bootstrap-touchspin.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/slick.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/OverlayScrollbars.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/normalize.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/costume.css");


        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/wNumb.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/nouislider.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.bootstrap-touchspin.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/OverlayScrollbars.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/popper.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slick.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/cleave.js");
        /*Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/maps.js");*/
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/my.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
        ?>
		<title><?php $APPLICATION->ShowTitle(); ?></title>
	</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>

<? if (ERROR_404 != 'Y'): ?>
	<div class="wrapper">

		<header class="header js-header">
			<div class="container">
				<div class="open-nav js-open-nav">
					<svg class="icon icon-burger">
						<use xlink:href="#icon-burger"></use>
					</svg>
					<svg class="icon icon-close3 header__close">
						<use xlink:href="#icon-close3"></use>
					</svg>
				</div>
                <? if ($page !== '/') { ?>
				<a href="/" class="logo">
                <? } else { ?>
					<div class="logo">
                <? } ?>
					<span class="logo-img">
			            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/logo.svg" alt="" title="" loading="lazy">
			        </span>
					<span class="logo-text">
	                       <?
                           $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                               "AREA_FILE_SHOW" => "file",
                               "PATH" => SITE_TEMPLATE_PATH . "/include/header/text_logo.php",
                               "EDIT_TEMPLATE" => ""
                           ], false, []);

                           ?>
	                </span>
                <? if ($page !== '/') { ?>
					</a>
                <? } else { ?>
					</div>
	            <? } ?>
			<form class="header__search" action="/search/">
				<div class="form-group">
					<input type="search" class="form-control js-open-search"
					       placeholder="Я ищу..." name="q">
					<button type="button" class="btn-search js-btn-search">
						<svg class="icon icon-search">
							<use xlink:href="#icon-search"></use>
						</svg>
					</button>
				</div>
			</form>
            <? $APPLICATION->IncludeComponent(
                "vpl:main.info",
                "header_phone",
                Array(
                    "PHONE" => "+7 (495) 748-06-65",
                )
            ); ?>
			<div class="header__links">
                <? if ($USER->IsAuthorized()) { ?>
					<a href="<?= SITE_DIR ?>personal/" class="header__link">
						<svg class="icon icon-acount">
							<use xlink:href="#icon-acount"></use>
						</svg>
					</a>
                <? } else { ?>
					<a href="#" data-toggle="modal" data-target="#modalEnter" class="header__link">
						<svg class="icon icon-acount">
							<use xlink:href="#icon-acount"></use>
						</svg>
					</a>
                <? } ?>
				<a href="/favorite/" class="header__link">
					<svg class="icon icon-favorite">
						<use xlink:href="#icon-favorite"></use>
					</svg>
				</a>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    "basket",
                    Array(
                        "HIDE_ON_BASKET_PAGES" => "N",
                        "PATH_TO_AUTHORIZE" => "",
                        "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                        "PATH_TO_PROFILE" => SITE_DIR."personal/",
                        "PATH_TO_REGISTER" => SITE_DIR."login/",
                        "POSITION_FIXED" => "N",
                        "SHOW_AUTHOR" => "N",
                        "SHOW_EMPTY_VALUES" => "N",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_PERSONAL_LINK" => "Y",
                        "SHOW_PRODUCTS" => "N",
                        "SHOW_REGISTRATION" => "N",
                        "SHOW_TOTAL_PRICE" => "N"
                    )
                );?>

			</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "header_catalog_menu",
                Array(
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COUNT_ELEMENTS" => "Y",
                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                    "FILTER_NAME" => "sectionsFilter",
                    "IBLOCK_ID" => "1",
                    "IBLOCK_TYPE" => "catalog",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array("NAME", ""),
                    "SECTION_ID" => "",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("UF_MENU_ICON", ""),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "2",
                    "VIEW_MODE" => "LINE"
                )
            );?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "header_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(0 => "",),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "header",
                    "USE_EXT" => "N"
                )
            ); ?>
	</div>
	<div class="mobile js-mobile">
		<div class="container">
			<div class="mobile__links">

                <? if ($USER->IsAuthorized()) { ?>
	                <a href="<?= SITE_DIR ?>personal/" class="mobile__link">
		                <span>
		                    <svg class="icon icon-acount">
		                        <use xlink:href="#icon-acount"></use>
		                    </svg>
		                </span>
		                Личный кабинет
	                </a>
                <? } else { ?>
	                <a href="#" class="mobile__link" data-toggle="modal" data-target="#modalEnter">
		                <span>
		                    <svg class="icon icon-acount">
		                        <use xlink:href="#icon-acount"></use>
		                    </svg>
		                </span>
		                Личный кабинет
	                </a>
                <? } ?>
				<a href="/favorite/" class="mobile__link">
                <span>
                    <svg class="icon icon-favorite">
                        <use xlink:href="#icon-favorite"></use>
                    </svg>
                </span>
					Избранное
				</a>
			</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "header_mobile_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "3",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "header_mobile",
                    "USE_EXT" => "Y"
                )
            );?>

            <? $APPLICATION->IncludeComponent(
                "vpl:main.info",
                "header_mobile",
                Array(
                    "COMPONENT_TEMPLATE" => "header_mobile",
                    "EMAIL" => "info@dr-d.ru",
                    "LINK_CALLBACK" => "#",
                    "PHONE" => "+7 495 748 06 65",
                    "STREET" => "Ленинградский пр-т, д. 24 стр. 3"
                )
            ); ?>
		</div>
	</div>
	<div class="overlay js-overlay">
	</div>
	</header>
	<main>

    <? if (!empty($APPLICATION->GetDirProperty('wrapper_on_container'))): ?>
	<div class="<?= $APPLICATION->GetDirProperty('wrapper_on_container') ?>">
<? endif; ?>

    <?

if ($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetDirProperty('wrapper') != 'Y'):

    ?>
	<div class="container">
	<h1>
        <?= $APPLICATION->ShowTitle(false) ?>
	</h1>
<? endif; ?>

<? endif; ?>