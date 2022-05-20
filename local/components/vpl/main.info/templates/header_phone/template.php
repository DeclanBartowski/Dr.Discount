<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\PhoneNumber\Format;
use Bitrix\Main\PhoneNumber\Parser;

if (!empty($arParams['PHONE'])) {
    $parsedPhone = Parser::getInstance()->parse(str_replace(' ', '', $arParams['PHONE']));
    $arParams['PHONE_FORMATED'] = $parsedPhone->format(Format::E164);
}
?>

<? if (!empty($arParams['PHONE'])): ?>
    <a href="tel:<?= $arParams['PHONE_FORMATED'] ?>" class="header__tel">
        <?= $arParams['PHONE'] ?>
    </a>
<? endif; ?>
