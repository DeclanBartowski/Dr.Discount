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
<div class="footer__heading">
    <? if (!empty($arParams['STREET'])): ?>
        <p>
            <?= $arParams['STREET'] ?>
        </p>
    <? endif; ?>
    <div class="footer__info">

        <? if (!empty($arParams['PHONE'])): ?>
            <a href="tel:<?= $arParams['PHONE_FORMATED'] ?>" class="footer__tel">
                <?= $arParams['PHONE'] ?>
            </a>
        <? endif; ?>

        <? if (!empty($arParams['EMAIL'])): ?>
            <a href="mailto:<?= $arParams['EMAIL'] ?>" class="footer__mail"><?= $arParams['EMAIL'] ?></a>
        <? endif; ?>
    </div>
    <div class="footer__contacts">
        <? if (!empty($arParams['LINK_CALLBACK'])): ?>
            <a href="<?= $arParams['LINK_CALLBACK'] ?>" target="_blank" class="footer__social">
                <svg class="icon icon-callback">
                    <use xlink:href="#icon-callback"></use>
                </svg>
            </a>
        <? endif; ?>
        <a href="javascript:void(0);" class="btn btn-outline-primary js-callback-modal" data-toogle="modal" data-target="#modalSend">
            <?= GetMessage('CALLBACK_MODAL') ?>
        </a>
    </div>
</div>