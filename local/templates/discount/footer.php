<?

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<? if (ERROR_404 != 'Y'): ?>
    <?
    if ($APPLICATION->GetCurPage(false) != '/' && $APPLICATION->GetDirProperty('wrapper') != 'Y'):

        ?>
        </div>
    <? endif; ?>

    <? if (! empty($APPLICATION->GetDirProperty('wrapper_on_container'))): ?>
        </div>
    <? endif; ?>


    </main>

    <footer class="footer">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                "vpl:main.info",
                "footer",
                [
                    "COMPONENT_TEMPLATE" => "footer",
                    "EMAIL" => "info@dr-d.ru",
                    "LINK_CALLBACK" => "#",
                    "PHONE" => "+7 495 748 06 65",
                    "STREET" => "Ленинградский пр-т, д. 24 стр. 3"
                ]
            ); ?>
        </div>
        <div class="footer__main">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    [
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => [0 => "",],
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer",
                        "USE_EXT" => "N"
                    ]
                ); ?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "footer",
                    [
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COUNT_ELEMENTS" => "N",
                        "COUNT_ELEMENTS_FILTER" => "CNT_ALL",
                        "FILTER_NAME" => "",
                        "IBLOCK_ID" => "1",
                        "IBLOCK_TYPE" => "catalog",
                        "SECTION_CODE" => "",
                        "SECTION_FIELDS" => [
                            0 => "",
                            1 => "",
                        ],
                        "SECTION_ID" => "",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => [
                            0 => "",
                            1 => "",
                        ],
                        "SHOW_PARENT_NAME" => "Y",
                        "TOP_DEPTH" => "2",
                        "VIEW_MODE" => "LINE",
                        "COMPONENT_TEMPLATE" => "footer"
                    ],
                    false
                ); ?>

                <div class="footer__bottom">
                    <div class="footer__notes">
                        <p>
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer/copyright.php",
                                "EDIT_TEMPLATE" => ""
                            ], false, []);

                            ?>
                        </p>

                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "footer_second",
                            [
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => [0 => "",],
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer_second",
                                "USE_EXT" => "N"
                            ]
                        ); ?>

                    </div>
                    <a href="/" class="footer__brand">
                        <?
                        $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/footer/logo_creater.php",
                            "EDIT_TEMPLATE" => ""
                        ], false, []);

                        ?>

                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="search-menu js-search-menu">
        <div class="container">
            <div class="search-menu__wrap js-search-menu__wrap">
                <?$APPLICATION->IncludeComponent("bitrix:catalog.search", "search_head", Array(
                    "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                    "AJAX_MODE" => "N",	// Включить режим AJAX
                    "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                    "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                    "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                    "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                    "BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
                    "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                    "CACHE_TYPE" => "A",	// Тип кеширования
                    "CHECK_DATES" => "N",	// Искать только в активных по дате документах
                    "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
                    "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                    "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                    "DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
                    "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                    "ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
                    "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
                    "ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
                    "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
                    "HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
                    "IBLOCK_ID" => "1",	// Инфоблок
                    "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                    "LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
                    "NO_WORD_LOGIC" => "N",	// Отключить обработку слов как логических операторов
                    "OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
                    "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                    "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                    "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                    "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                    "PAGER_TITLE" => "Товары",	// Название категорий
                    "PAGE_ELEMENT_COUNT" => "3",	// Количество элементов на странице
                    "PRICE_CODE" => array(	// Тип цены
                        0 => "Базовая",
                    ),
                    "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                    "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                    "PRODUCT_PROPERTIES" => "",	// Характеристики товара
                    "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
                    "PROPERTY_CODE" => array(	// Свойства
                        0 => "",
                        1 => "",
                    ),
                    "RESTART" => "N",	// Искать без учета морфологии (при отсутствии результата поиска)
                    "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
                    "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                    "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                    "USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
                    "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
                    "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
                    "USE_SEARCH_RESULT_ORDER" => "N",	// Использовать сортировку результатов по релевантности
                    "USE_TITLE_RANK" => "N",	// При ранжировании результата учитывать заголовки
                ),
                    false
                );?>
            </div>
        </div>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket.line",
        "foooter",
        Array(
            "HIDE_ON_BASKET_PAGES" => "N",
            "PATH_TO_AUTHORIZE" => "",
            "PATH_TO_BASKET" => SITE_DIR."basket/",
            "PATH_TO_ORDER" => SITE_DIR."order/",
            "PATH_TO_PERSONAL" => SITE_DIR."personal/",
            "PATH_TO_PROFILE" => SITE_DIR."personal/",
            "PATH_TO_REGISTER" => SITE_DIR."login/",
            "POSITION_FIXED" => "N",
            "SHOW_AUTHOR" => "N",
            "SHOW_DELAY" => "N",
            "SHOW_EMPTY_VALUES" => "Y",
            "SHOW_IMAGE" => "Y",
            "SHOW_NOTAVAIL" => "N",
            "SHOW_NUM_PRODUCTS" => "Y",
            "SHOW_PERSONAL_LINK" => "N",
            "SHOW_PRICE" => "Y",
            "SHOW_PRODUCTS" => "Y",
            "SHOW_REGISTRATION" => "N",
            "SHOW_SUMMARY" => "Y",
            "SHOW_TOTAL_PRICE" => "Y"
        )
    );?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "footer_mobile",
        [
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => [0 => "",],
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "footer_mobile",
            "USE_EXT" => "N"
        ]
    ); ?>



    <div class="filters js-filters">
        <div class="filters js-filters">
            <?$APPLICATION->ShowViewContent('form_filter');?>
        </div>
    </div>
    </div>

    <div class="modal fade modalBrand" id="modalBrand" tabindex="-1"
         aria-labelledby="modalBrand-1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title js_brand_title"></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-brand">
                        <div class="modal-brand__icon js_brand_image">
                        </div>
                        <div class="modal-brand__text js_brand_text">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-form" id="modalSend" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <? $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "",
            [
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "EDIT_URL" => "result_edit.php",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "LIST_URL" => "",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "",
                "USE_EXTENDED_ERRORS" => "N",
                "VARIABLE_ALIASES" => [
                    "RESULT_ID" => "RESULT_ID",
                    "WEB_FORM_ID" => "WEB_FORM_ID"
                ],
                "WEB_FORM_ID" => "1"
            ]
        ); ?>
    </div>


    <div class="modal fade modal-form modal-thanks" id="modalThanks" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ваша заявка отправлена</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        В ближайшее время <br>
                        с Вами свяжется менеджер
                    </p>
                    <button type="button" aria-label="Close" data-dismiss="modal"
                            class="btn btn-outline-primary">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-form" id="modalRegister" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Регистрация</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <? $APPLICATION->IncludeComponent(
                        "vpl:registration",
                        "",
                        [],
                        false,
                        []
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-form modal-enter" id="modalEnter" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вход на сайт</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <? $APPLICATION->IncludeComponent(
                        "vpl:auth",
                        "",
                        [],
                        false,
                        []
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-form modal-email" id="modalEmail" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ваша заявка отправлена</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <? $APPLICATION->IncludeComponent(
                        "vpl:forgotpassword",
                        "",
                        [],
                        false,
                        []
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-form" id="orderOneClickModal" tabindex="-1"
         aria-labelledby="orderOneClickModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Купить в 1 клик</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <form class="modal-body js-order-one-click">
                    <input type="hidden" name="productID" value="">
                    <div class="form-group form-group-required">
                        <label class="form-control-placeholder">
                            Представьтесь
                        </label>
                        <input type="text" placeholder="" class="form-control" name="NAME" required>
                    </div>
                    <div class="form-group form-group-required">
                        <label class="form-control-placeholder">
                            E-mail
                        </label>
                        <input type="email" placeholder="" class="form-control" name="EMAIL" required>
                    </div>
                    <div class="form-group form-group-required">
                        <label class="form-control-placeholder">
                            Телефон
                        </label>
                        <input type="tel" placeholder="" class="form-control" name="PHONE" required >
                    </div>
                    <div class="form-group">
                        <label class="form-control-placeholder">
                            Ваше сообщение
                        </label>
                        <textarea class="form-control" name="text"></textarea>
                    </div>

                    <div class="modal-btn">
                        <button type="submit" class="btn btn-primary">
                            Отправить
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" checked class="custom-control-input"
                                   id="modal-send" required>
                            <label class="custom-control-label"
                                   for="modal-send">Нажимая кнопку «Отправить»,
                                я даю свое <a href="/politika-konfidentsialnosti/">согласие на обработку моих персональных
                                    данных</a>, в
                                соответствии с Федеральным законом от 27.07.2006 года
                                №152-ФЗ</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade modal-form modal-thanks" id="modalThanksORder" tabindex="-1"
         aria-labelledby="modalSend"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Заказ оформлен</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        В ближайшее время <br>
                        с Вами свяжется менеджер
                    </p>
                    <button type="button" aria-label="Close" data-dismiss="modal"
                            class="btn btn-outline-primary">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    </div>
    <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;"
         version="1.1" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <symbol id="icon-close" viewBox="0 0 32 32">
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.9091" d="M30.545 1.455l-29.091 29.091"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.9091" d="M30.545 30.545l-29.091-29.091"></path>
            </symbol>

            <symbol id="icon-close3" viewBox="0 0 32 32">
                <path d="M8 8L23.9995 24" stroke-width="2" stroke-linecap="round"/>
                <path d="M24 8L8 23.9995" stroke-width="2" stroke-linecap="round"/>
            </symbol>


            <symbol id="icon-burger" viewBox="0 0 22 14">
                <path d="M1 1H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M1 7H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M1 13H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </symbol>
            <symbol id="icon-filters" viewBox="0 0 22 20">
                <path d="M1 3H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M1 10H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M1 17H21" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <circle cx="16" cy="10" r="3" fill="#252627"/>
                <circle cx="6" cy="3" r="3" fill="#252627"/>
                <circle cx="6" cy="17" r="3" fill="#252627"/>
            </symbol>


            <symbol id="icon-acount" viewBox="0 0 25 32">
                <path fill=""
                      d="M14.769 22.154l1.488 2.204 2.204 1.488-2.204 1.488-1.488 2.204-1.488-2.204-2.204-1.488 2.204-1.488 1.488-2.204z"></path>
                <path fill=""
                      d="M22.154 30.769c0 0.68 0.551 1.231 1.231 1.231s1.231-0.551 1.231-1.231h-2.462zM0 30.769c0 0.68 0.551 1.231 1.231 1.231s1.231-0.551 1.231-1.231h-2.462zM22.154 27.077v3.692h2.462v-3.692h-2.462zM2.462 30.769v-3.692h-2.462v3.692h2.462zM12.308 17.231c5.438 0 9.846 4.408 9.846 9.846h2.462c0-6.797-5.51-12.308-12.308-12.308v2.462zM12.308 14.769c-6.797 0-12.308 5.51-12.308 12.308h2.462c0-5.438 4.408-9.846 9.846-9.846v-2.462z"></path>
                <path fill="#fff"
                      d="M22.154 10.462c0 5.778-4.684 10.462-10.462 10.462s-10.462-4.684-10.462-10.462c0-5.778 4.684-10.462 10.462-10.462s10.462 4.684 10.462 10.462z"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="2.4615"
                      d="M18.462 10.462c0 3.739-3.031 6.769-6.769 6.769s-6.769-3.031-6.769-6.769c0-3.739 3.031-6.769 6.769-6.769s6.769 3.031 6.769 6.769z"></path>
            </symbol>
            <symbol id="icon-advant_1" viewBox="0 0 36 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308"
                      d="M8.691 25.679h-5.019c-1.356 0-2.441-0.949-2.441-2.17v-13.428c0-0.949 0.543-1.899 1.356-2.577l7.731-5.561c1.221-0.949 3.12-0.949 4.34 0l7.731 5.561c0.814 0.678 1.356 1.628 1.356 2.577v4.069"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308"
                      d="M14.117 30.427c1.498 0 2.713-1.215 2.713-2.713s-1.215-2.713-2.713-2.713-2.713 1.215-2.713 2.713c0 1.498 1.214 2.713 2.713 2.713z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308"
                      d="M27.681 30.427c1.498 0 2.713-1.215 2.713-2.713s-1.215-2.713-2.713-2.713-2.713 1.215-2.713 2.713c0 1.498 1.215 2.713 2.713 2.713z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308"
                      d="M11.405 27.714h-2.713v-13.564h17.633v2.713h5.425l2.713 5.425v5.425h-4.069"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308" d="M16.829 27.714h8.138"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.2308" d="M4.892 25.679v-15.598h16.005v4.069"></path>
            </symbol>
            <symbol id="icon-advant_3" viewBox="0 0 37 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.3333"
                      d="M10.266 5.633c5.733-5.733 15.067-5.733 20.8 0s5.733 15.067 0 20.8c-5.733 5.733-15.067 5.733-20.8 0"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.3333" d="M20.667 7.367v8.667h6"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.3333"
                      d="M14 22.701h-13.333v-12h5.2l1.467 2.667h6.667v9.333z"></path>
            </symbol>
            <symbol id="icon-advant_4" viewBox="0 0 27 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667"
                      d="M0.533 28.008v0.234c0 1.171 0.937 2.226 2.226 2.226h1.406c1.171 0 2.226-0.937 2.226-2.226v-0.82l1.523 0.468c3.748 1.289 7.731 1.874 11.713 1.874 0.937 0 2.226-0.703 2.226-1.64v-0.469c0-0.937-1.289-1.64-2.226-1.64h2.46c0.937 0 1.64-0.703 1.64-1.64s-0.703-1.64-1.64-1.64h1.874c0.937 0 1.64-0.703 1.64-1.64v-0.469c0-0.937-0.703-1.64-1.64-1.64h-0.937c0.937 0 1.64-0.703 1.64-1.64v-0.469c0-0.937-0.703-1.64-1.64-1.64h-5.154c-0.351 0-0.586-0.351-0.468-0.703 0.468-0.82 1.054-2.226 1.054-4.1 0-0.937-0.351-1.757-0.703-2.343-0.703-0.937-2.108-0.469-2.343 0.586-0.351 0.937-0.703 2.343-1.406 3.397-1.406 2.343-7.145 3.397-7.145 3.397h-6.325v13.002"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M6.273 28.477v-13.002"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M16.346 4.932v-3.865"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M10.606 2.941l2.928 2.928"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M22.086 2.941l-2.811 2.928"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M12.482 8.798h-3.748"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M24.078 8.798h-3.866"></path>
                <path fill="#014c84" style="fill: var(--color4, #014c84)"
                      d="M3.46 27.422c0.518 0 0.937-0.42 0.937-0.937s-0.42-0.937-0.937-0.937c-0.518 0-0.937 0.42-0.937 0.937s0.42 0.937 0.937 0.937z"></path>
            </symbol>
            <symbol id="icon-advant_5" viewBox="0 0 26 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1034"
                      d="M25.48 30.897h-24.376v-29.793h17.876l6.5 5.417v24.376z"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1034"
                      d="M13.293 24.125c3.74 0 6.771-3.032 6.771-6.771s-3.032-6.771-6.771-6.771c-3.74 0-6.771 3.032-6.771 6.771s3.032 6.771 6.771 6.771z"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1034" d="M10.584 17.354l1.896 1.896 3.386-3.386"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1034" d="M18.166 1.78v5.417h6.636"></path>
            </symbol>
            <symbol id="icon-anvant_2" viewBox="0 0 29 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1429"
                      d="M26.479 26.541c-5.832 5.832-15.325 5.832-21.156 0s-5.832-15.325 0-21.156 15.325-5.832 21.156 0"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1429"
                      d="M22.547 24.1h-13.291c-0.949 0-1.763-0.678-1.763-1.627v-10.036c0-0.814 0.407-1.492 1.085-1.899l5.832-4.069c0.949-0.678 2.306-0.678 3.255 0l5.832 4.069c0.678 0.407 1.085 1.221 1.085 1.899v10.036c-0.271 0.949-1.085 1.627-2.034 1.627z"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1429" d="M15.902 12.573v6.781"></path>
                <path fill="none" stroke="#1d94db" style="stroke: var(--color5, #1d94db)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1429" d="M19.292 15.963h-6.781"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.1429" d="M27.427 1.723v4.747h-4.747"></path>
            </symbol>
            <symbol id="icon-basket" viewBox="0 0 31 32">
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="4"
                      stroke-width="2.6667"
                      d="M27.586 7.077l-18.458-0c-0.736 0-1.333 0.597-1.333 1.333v11.692c0 0.736 0.597 1.333 1.333 1.333l15.26 0c0.601 0 1.128-0.402 1.286-0.982l3.198-11.692c0.232-0.848-0.406-1.685-1.286-1.685z"></path>
                <path fill="none"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="4"
                      stroke-width="2.6667" d="M7.077 1.333h-5.744"></path>
                <path d="M12.821 28.615c0 1.586-1.286 2.872-2.872 2.872s-2.872-1.286-2.872-2.872c0-1.586 1.286-2.872 2.872-2.872s2.872 1.286 2.872 2.872z"></path>
                <path d="M25.744 28.615c0 1.586-1.286 2.872-2.872 2.872s-2.872-1.286-2.872-2.872c0-1.586 1.286-2.872 2.872-2.872s2.872 1.286 2.872 2.872z"></path>
            </symbol>
            <symbol id="icon-callback" viewBox="0 0 32 32">
                <path fill="none" stroke="" class="icon-callback-stroke"
                      stroke-linejoin="round" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2632"
                      d="M16.248 0.842c-8.2 0-14.86 6.627-14.86 14.787 0 2.819 0.795 5.391 2.137 7.616l-2.684 7.913 8.25-2.621c2.137 1.187 4.572 1.83 7.206 1.83 8.2 0 14.86-6.627 14.86-14.787-0.050-8.111-6.709-14.738-14.909-14.738z"></path>
                <path fill="#fff"
                      d="M22.078 17.735c-0.29-0.159-1.823-0.955-2.113-1.074s-0.497-0.159-0.704 0.119c-0.207 0.278-0.87 0.955-1.036 1.153-0.207 0.199-0.373 0.199-0.704 0.040-0.29-0.159-1.325-0.517-2.485-1.591-0.911-0.835-1.491-1.869-1.657-2.148-0.166-0.318 0-0.477 0.166-0.597s0.331-0.358 0.497-0.517c0.166-0.159 0.207-0.278 0.331-0.477s0.083-0.358 0-0.517c-0.083-0.159-0.663-1.67-0.87-2.307-0.249-0.636-0.497-0.517-0.704-0.517-0.166 0-0.414-0.040-0.621-0.040s-0.539 0.040-0.87 0.358c-0.29 0.278-1.16 0.994-1.201 2.506s1.036 2.983 1.16 3.182c0.166 0.199 2.071 3.46 5.219 4.773s3.19 0.915 3.77 0.915c0.58-0.040 1.906-0.676 2.195-1.352 0.29-0.716 0.331-1.312 0.248-1.432-0.124-0.199-0.331-0.318-0.621-0.477z"></path>
            </symbol>


            <symbol id="icon-cat_1" viewBox="0 0 36 32">
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M3.311 13.042v-11.296h2.94v8.201"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M6.251 25.421v3.868h-2.94v-3.868"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M1.455 25.111h13.927v-4.487h-5.106v0.774h-8.82v3.714z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M1.455 16.91v-3.714h3.095"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M7.645 13.196h7.737v4.333h-5.106v-0.619l-4.178-0.774"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M19.096 7.007c1.538 0 2.785-1.247 2.785-2.785s-1.247-2.785-2.785-2.785c-1.538 0-2.785 1.247-2.785 2.785s1.247 2.785 2.785 2.785z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M31.783 7.007c1.538 0 2.785-1.247 2.785-2.785s-1.247-2.785-2.785-2.785c-1.538 0-2.785 1.247-2.785 2.785s1.247 2.785 2.785 2.785z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M21.57 5.304l3.095 17.021"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M29.308 5.304l-3.869 16.402-1.238 1.238"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M24.202 22.945v4.952l1.238 2.631 1.238-2.631v-4.952"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545"
                      d="M3.466 17.529c-0.619-0.31-0.774-1.083-0.464-1.702l4.178-7.118c0.309-0.619 1.083-0.774 1.702-0.464s0.774 1.083 0.464 1.702l-4.178 7.118c-0.309 0.464-1.083 0.774-1.702 0.464z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M21.57 5.304h2.321"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M27.76 5.304h1.547"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M3.002 17.683v3.095"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.4545" d="M6.097 17.683v3.095"></path>
            </symbol>
            <symbol id="icon-cat_2" viewBox="0 0 50 32">
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M48 2h-46v26.286h46v-26.286z"></path>
                <path fill="#4f6688" style="fill: var(--color6, #4f6688)"
                      d="M8.816 22.898h-0.939c-0.469 0-0.939-0.376-0.939-0.939v-0.939c0-0.469 0.375-0.939 0.939-0.939h1.033c0.469 0 0.939 0.376 0.939 0.939v0.939c-0.094 0.563-0.469 0.939-1.033 0.939z"></path>
                <path fill="#4f6688" style="fill: var(--color6, #4f6688)"
                      d="M9.192 14.918h-1.69c-0.282 0-0.563-0.282-0.563-0.563v-7.792c0-0.282 0.282-0.563 0.563-0.563h1.69c0.282 0 0.563 0.282 0.563 0.563v7.792c0 0.282-0.282 0.563-0.563 0.563z"></path>
                <path fill="#4f6688" style="fill: var(--color6, #4f6688)"
                      d="M8.347 13.042c1.296 0 2.347-1.051 2.347-2.347s-1.051-2.347-2.347-2.347c-1.296 0-2.347 1.051-2.347 2.347s1.051 2.347 2.347 2.347z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M14 2v26.286"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M8 28v2"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M42 28v2"></path>
                <path fill="#4f6688" style="fill: var(--color6, #4f6688)"
                      d="M41.898 24.53c1.296 0 2.347-1.051 2.347-2.347s-1.051-2.347-2.347-2.347c-1.296 0-2.347 1.051-2.347 2.347s1.051 2.347 2.347 2.347z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M18.71 8.102h15.865"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M35.326 11.389h-17.367v3.755h17.367v-3.755z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="2" d="M35.326 17.959h-17.367v3.755h17.367v-3.755z"></path>
            </symbol>
            <symbol id="icon-cat_3" viewBox="0 0 27 32">
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667"
                      d="M21.867 24.533h-20.8v-6.4h24.533v6.4h-5.867"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667"
                      d="M25.6 1.067h-24.533v13.867h24.533v-13.867z"></path>
                <path fill="#4f6688" style="fill: var(--color6, #4f6688)"
                      d="M4.576 22.4h-0.688c-0.344 0-0.688-0.284-0.688-0.711v-0.711c0-0.356 0.275-0.711 0.688-0.711h0.757c0.344 0 0.688 0.284 0.688 0.711v0.711c-0.069 0.427-0.344 0.711-0.757 0.711z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M7.467 18.133v6.4"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M4.267 24.533v1.067"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M22.4 24.533v1.067"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.0667" d="M22.4 20.267h-12.8v2.133h12.8v-2.133z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667"
                      d="M3.030 31.125c-0.789 0-1.429-0.64-1.429-1.429s0.64-1.429 1.429-1.429c0.789 0 1.429 0.64 1.429 1.429s-0.64 1.429-1.429 1.429z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667" d="M4.992 29.697h20.608"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667" d="M6.955 28.225v2.944"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667"
                      d="M21.867 8c0 1.031-0.798 2.090-2.372 2.923-1.55 0.82-3.727 1.344-6.162 1.344s-4.612-0.524-6.162-1.344c-1.573-0.833-2.372-1.892-2.372-2.923s0.798-2.090 2.372-2.923c1.55-0.82 3.727-1.344 6.162-1.344s4.612 0.524 6.162 1.344c1.573 0.833 2.372 1.892 2.372 2.923z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667" d="M1.067 14.4v4.8"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0667" d="M25.6 14.4v4.8"></path>
            </symbol>
            <symbol id="icon-cat_4" viewBox="0 0 32 32">
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M10.105 1.684v28.632"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M21.895 1.684v28.632"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M16 1.684v25.263"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M1.684 16h28.632"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M1.684 21.895h28.632"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842" d="M1.684 10.105h28.632"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842"
                      d="M28.463 30.316h-24.926c-1.011 0-1.853-0.842-1.853-1.853v-24.926c0-1.011 0.842-1.853 1.853-1.853h24.926c1.011 0 1.853 0.842 1.853 1.853v24.926c0 1.011-0.842 1.853-1.853 1.853z"></path>
                <path fill="none" stroke="#4f6688" style="stroke: var(--color6, #4f6688)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="1.6842"
                      d="M26.947 5.053h-21.895v21.895h21.895v-21.895z"></path>
            </symbol>
            <symbol id="icon-close_small" viewBox="0 0 32 32">
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4"
                      stroke-width="3.2" d="M1.6 1.6h28.8v28.8h-28.8v-28.8z"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4"
                      stroke-width="3.2" d="M9.6 9.6l12.8 12.8"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4"
                      stroke-width="3.2" d="M22.4 9.6l-12.8 12.8"></path>
            </symbol>

            <symbol id="icon-check" viewBox="0 0 13 10">
                <path fill="none" d="M1 5.5L4 8.5L11.5 1" stroke="white" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </symbol>


            <symbol id="icon-delivery_1" viewBox="0 0 31 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308"
                      d="M5.538 28.308h-4.308v-27.077h28.923v27.077h-3.692"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308"
                      d="M12.308 1.231v9.846l3.077-1.036 3.077 1.036v-9.846"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308" d="M4.923 17.231h9.846"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308" d="M4.923 20.923h7.385"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308"
                      d="M11.692 28.308c0 1.699-1.378 3.077-3.077 3.077s-3.077-1.378-3.077-3.077c0-1.699 1.378-3.077 3.077-3.077s3.077 1.378 3.077 3.077z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308"
                      d="M26.462 28.308c0 1.699-1.378 3.077-3.077 3.077s-3.077-1.378-3.077-3.077c0-1.699 1.378-3.077 3.077-3.077s3.077 1.378 3.077 3.077z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.2308" d="M13.538 28.308h4.923"></path>
            </symbol>
            <symbol id="icon-delivery_2" viewBox="0 0 26 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0323" d="M20.645 15.484h-4.129"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0323" d="M20.645 13.419h-7.226"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0323"
                      d="M9.115 19.613h-8.082v-18.581h23.742v18.581h-6.062"></path>
                <path fill="#014c84" style="fill: var(--color4, #014c84)"
                      d="M19.613 24.258l0.403 0.322 0.144-0.18-0.038-0.227-0.509 0.085zM19.097 30.968v0.516l0.142-1.012-0.142 0.496zM12.903 30.968l-0.482-0.185-0.27 0.701h0.751v-0.516zM15.484 24.258l0.482 0.185 0.066-0.173-0.059-0.176-0.49 0.163zM13.935 19.613l0.49-0.163c-0.069-0.207-0.26-0.348-0.478-0.353s-0.415 0.127-0.494 0.331l0.482 0.185zM11.355 26.323l-0.223 0.465 0.504 0.242 0.201-0.522-0.482-0.185zM5.161 25.806v0zM3.613 28.903h-0.516l1.019 0.117-0.503-0.117zM3.613 22.194l0.051-0.514-0.567-0.057v0.57h0.516zM8.774 22.71l-0.051 0.514 0.567 0.057v-0.57h-0.516zM18.581 19.097c0 1.066 0.132 2.382 0.262 3.419 0.065 0.521 0.13 0.977 0.179 1.303 0.024 0.163 0.045 0.293 0.059 0.383 0.007 0.045 0.013 0.080 0.017 0.104 0.002 0.012 0.003 0.021 0.004 0.027 0.001 0.003 0.001 0.005 0.001 0.007s0 0.001 0 0.002 0 0 0 0.001 0 0 0 0 0 0 0.509-0.085 0.509-0.085 0.509-0.085 0 0 0 0 0-0-0-0-0-0.001-0-0.002-0.001-0.003-0.001-0.006-0.002-0.014-0.004-0.025c-0.004-0.023-0.009-0.056-0.016-0.1-0.014-0.087-0.034-0.215-0.058-0.375-0.048-0.319-0.112-0.767-0.176-1.278-0.128-1.028-0.254-2.292-0.254-3.291h-1.032zM19.613 24.258c-0.403-0.322-0.403-0.322-0.403-0.322s0 0-0 0-0 0-0 0-0.001 0.001-0.001 0.001-0.003 0.003-0.005 0.006-0.010 0.012-0.018 0.022c-0.016 0.020-0.038 0.048-0.068 0.085-0.059 0.074-0.144 0.181-0.249 0.315-0.211 0.267-0.502 0.64-0.826 1.061-0.646 0.839-1.429 1.884-1.956 2.674l0.859 0.573c0.506-0.759 1.27-1.779 1.915-2.617 0.321-0.417 0.61-0.787 0.819-1.052 0.104-0.132 0.189-0.239 0.247-0.312 0.029-0.037 0.052-0.065 0.067-0.084 0.008-0.010 0.013-0.017 0.017-0.022 0.002-0.002 0.003-0.004 0.004-0.005s0.001-0.001 0.001-0.001 0-0 0-0 0 0 0 0 0-0-0.403-0.322zM16.087 28.101c-0.177 0.265-0.272 0.549-0.272 0.842 0 0.291 0.094 0.551 0.23 0.771 0.261 0.424 0.706 0.751 1.115 0.99 0.422 0.246 0.871 0.435 1.208 0.562 0.17 0.064 0.315 0.113 0.418 0.146 0.052 0.017 0.093 0.029 0.122 0.038 0.014 0.004 0.026 0.008 0.034 0.010 0.004 0.001 0.007 0.002 0.010 0.003 0.001 0 0.002 0.001 0.003 0.001s0.001 0 0.001 0 0 0 0 0 0 0 0.142-0.496 0.142-0.496 0.142-0.496 0 0 0 0 0 0 0 0-0-0-0.001-0-0.003-0.001-0.006-0.002-0.014-0.004-0.026-0.008c-0.023-0.007-0.059-0.018-0.104-0.033-0.090-0.029-0.22-0.073-0.373-0.13-0.308-0.116-0.698-0.281-1.050-0.487-0.365-0.213-0.63-0.434-0.756-0.639-0.058-0.094-0.077-0.169-0.077-0.23 0-0.060 0.017-0.147 0.099-0.269l-0.859-0.573zM19.097 30.452h-6.194v1.032h6.194v-1.032zM13.385 31.153l2.581-6.71-0.963-0.371-2.581 6.71 0.963 0.371zM15.973 24.095l-1.548-4.645-0.979 0.326 1.548 4.645 0.979-0.326zM13.454 19.428l-2.581 6.71 0.963 0.371 2.581-6.71-0.963-0.371zM11.355 26.323c0.223-0.465 0.223-0.465 0.223-0.465s-0-0-0-0-0.001-0-0.001-0.001-0.002-0.001-0.003-0.002-0.006-0.003-0.011-0.005-0.023-0.011-0.040-0.019c-0.035-0.016-0.085-0.039-0.149-0.067-0.128-0.056-0.311-0.134-0.537-0.223-0.45-0.176-1.073-0.396-1.759-0.565-0.683-0.169-1.451-0.293-2.185-0.266-0.731 0.028-1.479 0.208-2.063 0.703l0.667 0.788c0.342-0.29 0.831-0.436 1.435-0.459 0.601-0.023 1.266 0.080 1.899 0.236 0.63 0.155 1.208 0.359 1.63 0.524 0.21 0.082 0.381 0.155 0.497 0.206 0.058 0.026 0.103 0.046 0.133 0.060 0.015 0.007 0.026 0.012 0.033 0.015 0.004 0.002 0.006 0.003 0.008 0.004s0.001 0.001 0.002 0.001 0 0 0 0 0-0 0-0-0-0 0.223-0.465zM4.828 25.412c-0.622 0.526-1.047 1.408-1.309 2.083-0.136 0.35-0.237 0.67-0.305 0.902-0.034 0.117-0.059 0.212-0.077 0.279-0.009 0.034-0.015 0.060-0.020 0.079-0.002 0.009-0.004 0.017-0.005 0.022-0.001 0.003-0.001 0.005-0.001 0.006s-0 0.001-0 0.002-0 0-0 0.001-0 0-0 0-0 0 0.503 0.117 0.503 0.117 0.503 0.117 0 0-0 0 0 0 0 0 0-0 0-0.001 0-0.002 0.001-0.003 0.002-0.009 0.004-0.016c0.004-0.014 0.009-0.037 0.017-0.066 0.015-0.058 0.038-0.143 0.068-0.249 0.061-0.212 0.154-0.502 0.276-0.817 0.254-0.655 0.604-1.322 1.013-1.669l-0.667-0.788zM4.129 28.903v-6.71h-1.032v6.71h1.032zM3.562 22.707l5.161 0.516 0.103-1.027-5.161-0.516-0.103 1.027zM9.29 22.71v-4.129h-1.032v4.129h1.032z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.0323"
                      d="M10.323 1.032v8.258l2.581-0.869 2.581 0.869v-8.258"></path>
            </symbol>
            <symbol id="icon-delivery_3" viewBox="0 0 43 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6" d="M33.6 22.4h-6.4"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6" d="M33.6 19.2h-11.2"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6" d="M4 28v-27.2h35.2v27.2h-35.2z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6" d="M0.8 31.2v-3.2h41.6v3.2h-41.6z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6" d="M17.6 0v12.8l4-1.347 4 1.347v-12.8"></path>
            </symbol>
            <symbol id="icon-electonic" viewBox="0 0 28 32">
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.8824"
                      d="M23.059 17.412v-13.647c0-1.040-0.843-1.882-1.882-1.882h-14.588c-1.040 0-1.882 0.843-1.882 1.882v8"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.8824" d="M8.941 7.529h9.882"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.8235"
                      d="M17.302 11.765h-13.537c-1.040 0-1.882 0.843-1.882 1.882v14.588c0 1.040 0.843 1.882 1.882 1.882h20.235c1.040 0 1.882-0.843 1.882-1.882v-7.438c0-0.478-0.182-0.938-0.509-1.287l-6.698-7.15c-0.356-0.38-0.853-0.595-1.374-0.595z"></path>
            </symbol>
            <symbol id="icon-favorite" viewBox="0 0 25 32">
                <path d="M1.455 1.455v-1.455c-0.803 0-1.455 0.651-1.455 1.455h1.455zM20.364 2.909c0.803 0 1.455-0.651 1.455-1.455s-0.651-1.455-1.455-1.455v2.909zM1.455 30.545h-1.455c0 0.472 0.229 0.915 0.614 1.187s0.879 0.342 1.324 0.185l-0.484-1.372zM20.364 30.545l-0.484 1.372c0.445 0.157 0.939 0.088 1.324-0.185s0.614-0.715 0.614-1.187h-1.455zM10.909 27.212l0.484-1.372c-0.313-0.11-0.654-0.11-0.967 0l0.484 1.372zM21.818 22.566c0-0.803-0.651-1.455-1.455-1.455s-1.455 0.651-1.455 1.455h2.909zM1.455 2.909h18.909v-2.909h-18.909v2.909zM2.909 30.545v-29.091h-2.909v29.091h2.909zM20.847 29.174l-9.455-3.333-0.967 2.744 9.455 3.333 0.967-2.744zM10.425 25.84l-9.455 3.333 0.967 2.744 9.455-3.333-0.967-2.744zM18.909 22.566v7.98h2.909v-7.98h-2.909z"></path>
                <path d="M18.182 5.818l2.193 3.527 4.032 0.996-2.677 3.176 0.299 4.142-3.847-1.564-3.847 1.564 0.299-4.143-2.677-3.176 4.032-0.996 2.193-3.527z"></path>
            </symbol>
            <symbol id="icon-history" viewBox="0 0 34 32">
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="3.2" d="M11.2 9.6h11.2"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="3.2" d="M11.2 16h11.2"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="10"
                      stroke-width="3.2" d="M11.2 22.4h11.2"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="3.2"
                      d="M3.2 1.6h27.2c0.884 0 1.6 0.716 1.6 1.6v25.6c0 0.884-0.716 1.6-1.6 1.6h-27.2c-0.884 0-1.6-0.716-1.6-1.6v-25.6c0-0.884 0.716-1.6 1.6-1.6z"></path>
            </symbol>
            <symbol id="icon-close2" viewBox="0 0 9 9">
                <path d="M8 1L1 8" stroke-width="2" stroke-linecap="round"/>
                <path d="M8 8L1 1" stroke-width="2" stroke-linecap="round"/>
            </symbol>
            <symbol id="icon-next" viewBox="0 0 34 32">
                <path fill=""
                      d="M18.489 2.050c-0.614-0.635-1.61-0.635-2.224 0s-0.614 1.665 0 2.301l2.224-2.301zM29.953 16.208l1.112 1.15 1.112-1.15-1.112-1.15-1.112 1.15zM16.264 28.065c-0.614 0.635-0.614 1.665 0 2.301s1.61 0.635 2.224 0l-2.224-2.301zM16.264 4.35l12.576 13.008 2.224-2.301-12.576-13.008-2.224 2.301zM28.841 15.058l-12.576 13.008 2.224 2.301 12.576-13.008-2.224-2.301z"></path>
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="3.2" d="M0 15.997h28.8"></path>
            </symbol>
            <symbol id="icon-payment_1" viewBox="0 0 44 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6842"
                      d="M3.368 0.842h37.053c1.395 0 2.526 1.131 2.526 2.526v25.263c0 1.395-1.131 2.526-2.526 2.526h-37.053c-1.395 0-2.526-1.131-2.526-2.526v-25.263c0-1.395 1.131-2.526 2.526-2.526z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6842"
                      d="M0.842 9.263h42.105v5.053h-42.105v-5.053z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6842" d="M5.053 21.895h11.789"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.6842" d="M5.053 25.263h8.421"></path>
            </symbol>
            <symbol id="icon-payment_2" viewBox="0 0 34 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.5238"
                      d="M30.437 15.98c0 7.984-6.472 14.456-14.456 14.456s-14.456-6.472-14.456-14.456c0-7.984 6.472-14.456 14.456-14.456s14.456 6.472 14.456 14.456z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.5238"
                      d="M18.26 30.437c7.984 0 14.456-6.472 14.456-14.456s-6.472-14.456-14.456-14.456"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.5238"
                      d="M13.55 22.927v-13.714h4.329c1.893 0 3.429 1.535 3.429 3.429v0c0 1.894-1.535 3.429-3.429 3.429h-7.238"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.5238" d="M10.641 19.879h7.619"></path>
            </symbol>
            <symbol id="icon-payment_3" viewBox="0 0 35 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545"
                      d="M4.8 29.236l-0.36-0.27-3.713 1.857v-30.096h32.727v29.988l-3.022-1.813-2.182 2.182-3.524-2.114-3.636 2.182-3.636-2.182-3.591 2.155-2.909-2.182-3.636 2.182-2.518-1.888z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M4.364 5.818h10.182"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M4.364 18.909h24.727"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M17.455 5.818h11.636"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M4.364 10.182h8.727"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M4.364 21.818h20.364"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color4, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.4545" d="M17.455 10.182h7.273"></path>
            </symbol>
            <symbol id="icon-prev" viewBox="0 0 34 32">
                <path fill="none"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="3.2" d="M4 16h28.8"></path>
                <path fill=""
                      d="M14.664 30.366c0.614 0.635 1.61 0.635 2.224 0s0.614-1.665 0-2.301l-2.224 2.301zM3.2 16.208l-1.112-1.15-1.112 1.15 1.112 1.15 1.112-1.15zM16.889 4.35c0.614-0.635 0.614-1.665 0-2.301s-1.61-0.635-2.224 0l2.224 2.301zM16.889 28.065l-12.576-13.008-2.224 2.301 12.576 13.008 2.224-2.301zM4.312 17.358l12.576-13.008-2.224-2.301-12.576 13.008 2.224 2.301z"></path>
            </symbol>
            <symbol id="icon-quote-blue" viewBox="0 0 47 32">
                <path fill="#fff" style="fill: var(--color3, #fff)"
                      d="M25 31.677c0-1.249 0-2.453 0-3.664 4.799-0.288 8.002-2.687 9.72-7.214-0.401-0.091-0.742-0.159-1.075-0.242-4.375-1.060-7.563-4.875-7.888-9.432-0.318-4.436 2.347-8.69 6.488-10.348 6.366-2.551 13.376 1.529 14.262 8.342 0.288 2.195-0.061 4.353-0.621 6.472-2.195 8.267-8.94 14.413-17.373 15.814-1.052 0.174-2.127 0.197-3.195 0.288-0.098 0.008-0.197-0.015-0.318-0.015z"></path>
                <path fill="#6ac1f0" style="fill: var(--color8, #6ac1f0)"
                      d="M25 31.677c0-1.249 0-2.453 0-3.664 4.799-0.288 8.002-2.687 9.72-7.214-0.401-0.091-0.742-0.159-1.075-0.242-4.375-1.060-7.563-4.875-7.888-9.432-0.318-4.436 2.347-8.69 6.488-10.348 6.366-2.551 13.376 1.529 14.262 8.342 0.288 2.195-0.061 4.353-0.621 6.472-2.195 8.267-8.94 14.413-17.373 15.814-1.052 0.174-2.127 0.197-3.195 0.288-0.098 0.008-0.197-0.015-0.318-0.015z"></path>
                <path fill="#fff" style="fill: var(--color3, #fff)"
                      d="M0 31.692c0-1.264 0-2.468 0-3.679 4.799-0.288 8.002-2.687 9.72-7.199-0.167-0.045-0.265-0.083-0.371-0.098-4.943-0.886-8.554-5.125-8.615-10.114-0.061-5.034 3.429-9.372 8.342-10.386 6.094-1.257 11.976 3.119 12.468 9.311 0.242 3.036-0.409 5.95-1.552 8.743-3.263 7.994-10.946 13.248-19.591 13.422-0.121 0-0.25 0-0.401 0z"></path>
                <path fill="#6ac1f0" style="fill: var(--color8, #6ac1f0)"
                      d="M0 31.692c0-1.264 0-2.468 0-3.679 4.799-0.288 8.002-2.687 9.72-7.199-0.167-0.045-0.265-0.083-0.371-0.098-4.943-0.886-8.554-5.125-8.615-10.114-0.061-5.034 3.429-9.372 8.342-10.386 6.094-1.257 11.976 3.119 12.468 9.311 0.242 3.036-0.409 5.95-1.552 8.743-3.263 7.994-10.946 13.248-19.591 13.422-0.121 0-0.25 0-0.401 0z"></path>
            </symbol>
            <symbol id="icon-quote-gray" viewBox="0 0 51 32">
                <path fill="#e2e6f1" style="fill: var(--color9, #e2e6f1)"
                      d="M28.235 11.369c0-6.279 5.090-11.368 11.368-11.368s11.368 5.090 11.368 11.368c0 6.279-5.090 11.368-11.368 11.368s-11.368-5.090-11.368-11.368z"></path>
                <path fill="#e2e6f1" style="fill: var(--color9, #e2e6f1)"
                      d="M50.972 14.883v-3.094h-8.421v20.211l3.872-4.617c2.938-3.503 4.549-7.928 4.549-12.5z"></path>
                <path fill="#e2e6f1" style="fill: var(--color9, #e2e6f1)"
                      d="M-0 11.369c0-6.279 5.090-11.368 11.368-11.368s11.368 5.090 11.368 11.368c0 6.279-5.090 11.368-11.368 11.368s-11.368-5.090-11.368-11.368z"></path>
                <path fill="#e2e6f1" style="fill: var(--color9, #e2e6f1)"
                      d="M22.736 14.883v-3.094h-8.421v20.211l3.872-4.617c2.938-3.503 4.549-7.928 4.549-12.5z"></path>
            </symbol>
            <symbol id="icon-recommend" viewBox="0 0 32 32">
                <path fill="none" stroke="#02c392" style="stroke: var(--color10, #02c392)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.2857"
                      d="M7.841 23.523c4.33 4.33 11.352 4.33 15.682 0s4.331-11.352 0-15.682-11.352-4.33-15.682 0"></path>
                <path fill="none" stroke="#02c392" style="stroke: var(--color10, #02c392)"
                      stroke-linejoin="round" stroke-linecap="round" stroke-miterlimit="4"
                      stroke-width="2.2857" d="M15.95 10.17v5.78h3.853"></path>
                <path fill="none" stroke="#02c392" style="stroke: var(--color10, #02c392)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.2857" d="M11.561 12.096h-11.561"></path>
                <path fill="none" stroke="#02c392" style="stroke: var(--color10, #02c392)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.2857" d="M11.56 15.949h-9.634"></path>
                <path fill="none" stroke="#02c392" style="stroke: var(--color10, #02c392)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.2857" d="M11.561 19.804h-7.707"></path>
            </symbol>
            <symbol id="icon-recommendations" viewBox="0 0 31 32">
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4"
                      stroke-width="2.2069"
                      d="M14.511 2.611c0.432-0.694 1.442-0.694 1.874 0l4.002 6.436c0.152 0.244 0.393 0.42 0.673 0.489l7.358 1.817c0.794 0.196 1.106 1.157 0.579 1.782l-4.885 5.795c-0.185 0.22-0.278 0.504-0.257 0.791l0.546 7.559c0.059 0.816-0.759 1.41-1.516 1.102l-7.021-2.855c-0.266-0.108-0.565-0.108-0.831 0l-7.021 2.855c-0.757 0.308-1.575-0.286-1.516-1.102l0.546-7.559c0.021-0.287-0.071-0.571-0.257-0.791l-4.885-5.795c-0.527-0.625-0.215-1.586 0.579-1.782l7.358-1.817c0.279-0.069 0.521-0.244 0.673-0.489l4.002-6.436z"></path>
                <path fill="none" stroke-linejoin="round" stroke-linecap="round"
                      stroke-miterlimit="4"
                      stroke-width="2.2069" d="M12.69 16l2.207 2.207 4.414-4.414"></path>
            </symbol>
            <symbol id="icon-sale" viewBox="0 0 40 32">
                <path fill="#cb6565" style="fill: var(--color11, #cb6565)"
                      d="M16 8c0 4.418-3.582 8-8 8s-8-3.582-8-8c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                <path fill="#cb6565" style="fill: var(--color11, #cb6565)"
                      d="M40 24c0 4.418-3.582 8-8 8s-8-3.582-8-8c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                <path fill="none" stroke="#cb6565" style="stroke: var(--color11, #cb6565)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="4" d="M9.785 27.033l20.43-22.066"></path>
            </symbol>
            <symbol id="icon-search" viewBox="0 0 30 32">
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.0476"
                      d="M17.951 7.915c2.772 2.772 2.772 7.265 0 10.037s-7.265 2.772-10.037 0c-2.772-2.772-2.772-7.265 0-10.037s7.265-2.772 10.037 0z"></path>
                <path d="M23.324 25.669c0.595 0.595 1.56 0.595 2.154 0s0.595-1.56 0-2.154l-2.154 2.154zM22.43 20.466c-0.595-0.595-1.559-0.595-2.154 0s-0.595 1.56 0 2.154l2.154-2.154zM25.478 23.514l-3.049-3.049-2.154 2.154 3.049 3.049 2.154-2.154z"></path>
            </symbol>
            <symbol id="icon-star" viewBox="0 0 32 32">
                <path fill="#9f7300" style="fill: var(--color12, #9f7300)"
                      d="M15.728 0.072l6.31 9.345 9.345 6.31-9.345 6.31-6.31 9.345-6.31-9.345-9.345-6.31 9.345-6.31 6.31-9.345z"></path>
            </symbol>
            <symbol id="icon-star2" viewBox="0 0 32 32">
                <path fill=""
                      d="M15.463 3.203l5.181 8.333 9.526 2.352-6.324 7.502 0.706 9.786-9.089-3.696-9.089 3.696 0.706-9.786-6.324-7.502 9.526-2.352 5.181-8.333z"></path>
            </symbol>
            <symbol id="icon-view_1" viewBox="0 0 34 32">
                <path fill=""
                      d="M4 0h6c2.209 0 4 1.791 4 4v4.182c0 2.209-1.791 4-4 4h-6c-2.209 0-4-1.791-4-4v-4.182c0-2.209 1.791-4 4-4z"></path>
                <path fill=""
                      d="M4 18.182h6c2.209 0 4 1.791 4 4v4.182c0 2.209-1.791 4-4 4h-6c-2.209 0-4-1.791-4-4v-4.182c0-2.209 1.791-4 4-4z"></path>
                <path fill=""
                      d="M24 0h6c2.209 0 4 1.791 4 4v4.182c0 2.209-1.791 4-4 4h-6c-2.209 0-4-1.791-4-4v-4.182c0-2.209 1.791-4 4-4z"></path>
                <path fill=""
                      d="M24 18.182h6c2.209 0 4 1.791 4 4v4.182c0 2.209-1.791 4-4 4h-6c-2.209 0-4-1.791-4-4v-4.182c0-2.209 1.791-4 4-4z"></path>
            </symbol>
            <symbol id="icon-view_2" viewBox="0 0 43 32">
                <path fill=""
                      d="M23.467 0h14.933c2.356 0 4.267 1.91 4.267 4.267v4.267c0 2.356-1.91 4.267-4.267 4.267h-14.933c-2.356 0-4.267-1.91-4.267-4.267v-4.267c0-2.356 1.91-4.267 4.267-4.267z"></path>
                <path fill=""
                      d="M4.267 0h4.267c2.356 0 4.267 1.91 4.267 4.267v4.267c0 2.356-1.91 4.267-4.267 4.267h-4.267c-2.356 0-4.267-1.91-4.267-4.267v-4.267c0-2.356 1.91-4.267 4.267-4.267z"></path>
                <path fill=""
                      d="M23.467 19.2h14.933c2.356 0 4.267 1.91 4.267 4.267v4.267c0 2.356-1.91 4.267-4.267 4.267h-14.933c-2.356 0-4.267-1.91-4.267-4.267v-4.267c0-2.356 1.91-4.267 4.267-4.267z"></path>
                <path fill=""
                      d="M4.267 19.2h4.267c2.356 0 4.267 1.91 4.267 4.267v4.267c0 2.356-1.91 4.267-4.267 4.267h-4.267c-2.356 0-4.267-1.91-4.267-4.267v-4.267c0-2.356 1.91-4.267 4.267-4.267z"></path>
            </symbol>


            <symbol id="icon-external" viewBox="0 0 32 32">
                <path d="M19.556 0v3.556h6.382l-17.476 17.476 2.507 2.507 17.475-17.476v6.382h3.556v-12.444h-12.444zM28.444 28.444h-24.889v-24.889h12.444v-3.556h-12.444c-1.973 0-3.556 1.6-3.556 3.556v24.889c0 0.943 0.375 1.848 1.041 2.514s1.571 1.041 2.514 1.041h24.889c0.943 0 1.848-0.375 2.514-1.041s1.041-1.571 1.041-2.514v-12.444h-3.556v12.444z"></path>
            </symbol>
            <symbol id="icon-pdf" viewBox="0 0 32 32">
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="1.6"
                      d="M8.8 0.8h17.269l5.131 5.131v25.269h-22.4v-30.4z"></path>
                <path d="M0.001 12.227h28.897v14.448h-28.897v-14.448z"></path>
                <path fill="#fff"
                      d="M6.297 20.657h-2.39v-1.507h2.39c0.369 0 0.67-0.060 0.902-0.18 0.232-0.124 0.402-0.296 0.509-0.515s0.161-0.466 0.161-0.741c0-0.279-0.054-0.539-0.161-0.779s-0.277-0.434-0.509-0.58c-0.232-0.146-0.532-0.219-0.902-0.219h-1.72v7.865h-1.932v-9.379h3.652c0.734 0 1.363 0.133 1.887 0.399 0.528 0.262 0.932 0.625 1.211 1.089s0.419 0.994 0.419 1.591c0 0.605-0.14 1.129-0.419 1.572s-0.683 0.784-1.211 1.024c-0.524 0.24-1.153 0.361-1.887 0.361zM14.026 24h-2.042l0.013-1.507h2.029c0.507 0 0.934-0.114 1.282-0.341 0.348-0.232 0.61-0.569 0.786-1.011 0.18-0.442 0.271-0.977 0.271-1.604v-0.457c0-0.481-0.052-0.904-0.155-1.269-0.099-0.365-0.247-0.672-0.444-0.921s-0.44-0.436-0.728-0.56c-0.288-0.129-0.618-0.193-0.992-0.193h-2.1v-1.514h2.1c0.627 0 1.2 0.107 1.72 0.322 0.524 0.21 0.977 0.513 1.359 0.908s0.676 0.867 0.882 1.417c0.21 0.545 0.316 1.153 0.316 1.823v0.444c0 0.666-0.105 1.273-0.316 1.823-0.206 0.55-0.5 1.022-0.882 1.417-0.378 0.391-0.831 0.693-1.359 0.908-0.524 0.21-1.104 0.316-1.739 0.316zM13.079 14.621v9.379h-1.932v-9.379h1.932zM21.659 14.621v9.379h-1.932v-9.379h1.932zM25.395 18.628v1.507h-4.264v-1.507h4.264zM25.846 14.621v1.514h-4.715v-1.514h4.715z"></path>
            </symbol>

            <symbol id="icon-top" viewBox="0 0 54 32">
                <path fill="none" stroke-linejoin="miter" stroke-linecap="round"
                      stroke-miterlimit="4" stroke-width="4"
                      d="M2.001 28.698l24.698-24.698 24.698 24.698"></path>
            </symbol>


            <symbol id="icon-top2" viewBox="0 0 16 10">
                <path fill="none" d="M14.123 8.375L7.75909 2.01104L1.39512 8.375"
                      stroke="white"
                      stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"/>
            </symbol>


            <symbol id="icon-clock" viewBox="0 0 30 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="3"
                      d="M28.5 16c0 7.456-6.044 13.5-13.5 13.5s-13.5-6.044-13.5-13.5c0-7.456 6.044-13.5 13.5-13.5s13.5 6.044 13.5 13.5z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2" d="M15 10.375v5.625h3.75"></path>
            </symbol>
            <symbol id="icon-mail" viewBox="0 0 37 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="4"
                      d="M5.333 4h26.667c1.473 0 2.667 1.194 2.667 2.667v18.667c0 1.473-1.194 2.667-2.667 2.667h-26.667c-1.473 0-2.667-1.194-2.667-2.667v-18.667c0-1.473 1.194-2.667 2.667-2.667z"></path>
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.6667" d="M4.667 5l14 11 15-11"></path>
            </symbol>
            <symbol id="icon-pin" viewBox="0 0 26 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="2.8235"
                      d="M23.141 13.57c0 3.982-2.724 8.017-5.752 11.218-1.48 1.565-2.966 2.86-4.083 3.764-0.397 0.321-0.746 0.592-1.030 0.807-0.284-0.215-0.633-0.486-1.030-0.807-1.117-0.904-2.602-2.199-4.083-3.764-3.028-3.201-5.752-7.237-5.752-11.218 0-5.972 4.892-10.864 10.864-10.864s10.864 4.892 10.864 10.864z"></path>
                <path fill="none" stroke="#044988" style="stroke: var(--color2, #044988)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="1.8824"
                      d="M15.72 13.57c0 1.902-1.542 3.443-3.443 3.443s-3.443-1.542-3.443-3.443c0-1.902 1.542-3.443 3.443-3.443s3.443 1.542 3.443 3.443z"></path>
            </symbol>
            <symbol id="icon-tel" viewBox="0 0 28 32">
                <path fill="none" stroke="#014c84" style="stroke: var(--color1, #014c84)"
                      stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4"
                      stroke-width="3.2"
                      d="M18.488 28.384c-0.774 0.007-1.706-0.136-2.618-0.412-1.22-0.368-2.341-0.938-3.405-1.632-0.667-0.435-1.304-0.91-1.906-1.429-0.438-0.376-0.868-0.762-1.281-1.165-0.459-0.446-0.905-0.905-1.34-1.374-0.662-0.714-1.288-1.46-1.883-2.23-0.566-0.732-1.098-1.484-1.585-2.271-0.702-1.134-1.301-2.32-1.728-3.587-0.227-0.67-0.399-1.353-0.501-2.055-0.076-0.53-0.118-1.061-0.105-1.596 0.026-1.058 0.225-2.081 0.641-3.059 0.29-0.683 0.67-1.311 1.144-1.883 0.373-0.451 0.796-0.848 1.262-1.204 0.242-0.185 0.462-0.397 0.689-0.6 0.279-0.248 0.571-0.477 0.929-0.6 0.451-0.156 0.879-0.094 1.29 0.136 0.438 0.247 0.775 0.607 1.084 0.994 0.462 0.581 0.832 1.223 1.233 1.846 0.26 0.402 0.498 0.818 0.693 1.256 0.18 0.406 0.32 0.822 0.362 1.264 0.066 0.689-0.112 1.309-0.59 1.815-0.281 0.297-0.603 0.553-0.902 0.835-0.292 0.277-0.639 0.483-0.955 0.728-0.342 0.266-0.602 0.592-0.714 1.020-0.086 0.328-0.079 0.655-0.019 0.985 0.107 0.586 0.352 1.119 0.639 1.633 0.441 0.788 0.981 1.505 1.554 2.2 0.579 0.702 1.187 1.379 1.848 2.007 0.592 0.564 1.217 1.090 1.945 1.476 0.422 0.222 0.863 0.385 1.35 0.388 0.436 0.002 0.821-0.14 1.15-0.419 0.187-0.157 0.349-0.346 0.526-0.514 0.195-0.187 0.389-0.373 0.594-0.55 0.261-0.229 0.524-0.459 0.8-0.668 0.339-0.256 0.727-0.406 1.152-0.443 0.417-0.037 0.819 0.042 1.208 0.195 0.517 0.204 0.986 0.495 1.416 0.842 0.501 0.406 0.986 0.829 1.478 1.246 0.342 0.29 0.668 0.597 0.957 0.942 0.268 0.32 0.501 0.659 0.628 1.062 0.162 0.513 0.060 0.975-0.247 1.405-0.167 0.235-0.384 0.422-0.599 0.612-0.298 0.266-0.597 0.53-0.89 0.801-0.425 0.393-0.894 0.727-1.397 1.011-0.693 0.391-1.431 0.662-2.209 0.824-0.496 0.105-1.002 0.156-1.694 0.169z"></path>
            </symbol>


            <symbol id="icon-sort1" viewBox="0 0 42 32">
                <path d="M1.016 21.884l7.923 9.37 7.923-9.37h-15.845z"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.2"
                      d="M8.756 29.195v-29.195"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.2"
                      d="M23.353 3.649h18.247"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.2"
                      d="M23.353 12.164h14.597"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.2"
                      d="M23.353 20.682h10.948"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="3.2"
                      d="M23.353 29.195h7.299"></path>
            </symbol>
            <symbol id="icon-sort2" viewBox="0 0 26 32">
                <path d="M0.923 19.895l7.202 8.518 7.202-8.518h-14.405z"></path>
                <path fill="none" stroke-linejoin="miter" stroke-linecap="butt"
                      stroke-miterlimit="4" stroke-width="2.9091"
                      d="M7.96 26.54v-26.54"></path>
                <path d="M24.997 12.224l-1.226-3.686h-3.946l-1.212 3.686h-1.158l3.892-11.636h0.963l3.872 11.636h-1.185zM23.414 7.326l-1.145-3.591c-0.148-0.454-0.301-1.012-0.458-1.673-0.099 0.507-0.24 1.065-0.424 1.673l-1.158 3.591h3.185z"></path>
                <path d="M22.304 24.824l-3.18 4.855h-1.669l3.405-5.086c-0.891-0.271-1.539-0.679-1.943-1.226-0.404-0.552-0.606-1.247-0.606-2.085 0-1.040 0.374-1.839 1.121-2.396 0.753-0.562 1.89-0.844 3.413-0.844h3.338v11.636h-1.412v-4.855h-2.466zM24.77 19.213h-1.885c-1.013 0-1.783 0.167-2.308 0.501s-0.789 0.878-0.789 1.632c0 1.544 1.049 2.316 3.147 2.316h1.835v-4.449z"></path>
            </symbol>

        </defs>
    </svg>
    <svg class="svg" aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;">
        <clipPath id="svgPath" class="svgPath"
                  clipPathUnits="objectBoundingBox">
            <path d="M0.951,0.361 C1,0.443,1,0.563,0.951,0.645 V0.645 C0.858,0.756,0.756,0.858,0.645,0.951 V0.951 C0.563,1,0.443,1,0.361,0.951 V0.951 C0.25,0.858,0.147,0.756,0.054,0.645 V0.645 C-0.014,0.563,-0.014,0.443,0.054,0.361 V0.361 C0.147,0.25,0.25,0.147,0.361,0.054 V0.054 C0.443,-0.014,0.563,-0.014,0.645,0.054 V0.054 C0.756,0.147,0.858,0.25,0.951,0.361 V0.361,NaN"></path>
        </clipPath>
    </svg>
<? endif; ?>
</body>
</html>
