<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>


    <div class="wrapper wrapper--error">
        <div class="error-head">
            <div class="container">
                <a href="/" class="logo">
            <span class="logo-img">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/logo.svg" alt="" loading="lazy" title="">
            </span>
                    <span class="logo-text">
                Доверие нам – надежность вам
            </span>
                </a>
            </div>
        </div>
        <main>
            <div class="section error-body">
                <div class="container">
                    <div class="row align-items-center flex-md-row-reverse">
                        <div class="col-lg-4 mb-30">
                            <div class="error-number">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/error/error.png" alt="Тут описание"
                                     title="Тут подсказка" loading="lazy">
                                <p>
                                    Страница не найдена
                                </p>
                            </div>

                        </div>
                        <div class="col-lg-8 mb-30">
                            <div class="error-links">
                                <a href="/" class="btn btn-outline-primary">
                                    Главная страница
                                </a>
                                <a href="/sitemap/" class="btn btn-outline-primary">
                                    Карта сайта
                                </a>
                            </div>
                            <p>Здравствуйте, уважаемый посетитель нашего сайта!</p>
                            <p>
                                К сожалению, запрашиваемая Вами страница не найдена на сайте
                                нашей компании. Возможно, это
                                случилось по одной из следующих причин:
                            </p>
                            <ul class="">
                                <li>вы ошиблись при наборе адреса страницы (URL);</li>
                                <li>вы перешли по «битой» (неработающей, неправильной)
                                    ссылке;
                                </li>
                                <li>запрашиваемой страницы никогда не было на сайте или она
                                    была удалена/ перемещена.
                                </li>
                            </ul>
                            <p>Мы приносим свои Извинения за доставленные неудобства
                                и предлагаем следующие пути:</p>
                            <ul class="typical-list">
                                <li>вернуться назад при помощи кнопки браузера back;</li>
                                <li>проверить правильность написания адреса страницы (URL);
                                </li>
                                <li>воспользоватсья навигацией вверху страницы.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>




<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>