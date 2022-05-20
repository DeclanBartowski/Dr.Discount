<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

?>
<div class="product">
    <? if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])): ?>
        <div class="product__gallery">
            <div class="product__slider js-product__slider">
                <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo): ?>
                    <div class="">
                        <img src="<?= CFile::GetPath($photo) ?>" alt="<?= $arResult['NAME'] ?>"
                             title="<?= $arResult['NAME'] ?>" loading="lazy">
                    </div>
                <? endforeach; ?>
            </div>
            <div class="product__thumbs js-product__thumbs">
                <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo): ?>
                    <div class="">
                        <div class="product__thumb">
                            <img src="<?= CFile::GetPath($photo) ?>" alt="<?= $arResult['NAME'] ?>"
                                 title="<?= $arResult['NAME'] ?>" loading="lazy">
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="btn-wrap">
                <button class="slick__btn slick__prev js-product__prev">
                    <svg class="icon icon-prev">
                        <use xlink:href="#icon-prev"></use>
                    </svg>
                </button>
                <button class="slick__btn slick__next js-product__next">
                    <svg class="icon icon-next">
                        <use xlink:href="#icon-next"></use>
                    </svg>
                </button>
            </div>
        </div>
    <? endif; ?>
    <div class="product__info">

        <? if ($arResult['PROPERTIES']['LABELS']['VALUE']) { ?>
            <div class="tags">
                <?foreach ($arResult['PROPERTIES']['LABELS']['VALUE'] as $key => $label) {
                    $icons = explode('/', $arResult['PROPERTIES']['LABELS']['VALUE_XML_ID'][$key]);
                    ?>
                    <div class="tag <?= $icons[0];?>">
		                        <span>
		                          <svg class="icon <?= $icons[1];?>">
		                            <use xlink:href="#<?= $icons[1];?>"></use>
		                          </svg>
		                        </span>
                        <?= $label;?>
                    </div>
                <?}?>
            </div>
        <? } ?>
        <div class="product__title">
            <?= $arResult['NAME'] ?>
        </div>
        <div class="product__wrap">
            <? if (!empty($arResult['PROPERTIES']['ARTNUMBER']['VALUE'])): ?>
                <div class="product__article">
                    Артикул: <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE'] ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult['BRANDS'])): ?>
                <a href="<?= $arResult['BRANDS']['DETAIL_PAGE_URL'] ?>" class="product__brand">
                    <? if (!empty($arResult['BRANDS']['PREVIEW_PICTURE'])): ?>
                        <span class="product__brand-icon">
                        <img src="<?= CFile::GetPath($arResult['BRANDS']['PREVIEW_PICTURE']) ?>" loading="lazy"
                             title="<?= $arResult['BRANDS']['NAME'] ?>" alt="<?= $arResult['BRANDS']['NAME'] ?>">
                    </span>
                    <? endif; ?>
                    <span class="product__brand-text">
                        <?= $arResult['BRANDS']['NAME'] ?>
                    </span>
                </a>
            <? endif; ?>
        </div>
        <div class="product__wrapper">
            <div class="card__prices">
                    <div class="card__price">
                        <?=$arResult["MIN_PRICE"]['PRINT_DISCOUNT_VALUE']?>
                    </div>
                <?if(!empty($arResult["MIN_PRICE"]['DISCOUNT_DIFF']) || !empty($arResult["MIN_PRICE"]['DISCOUNT_DIFF_PERCENT'])):?>
                    <div class="card__discount">
                        <?=$arResult["MIN_PRICE"]['PRINT_VALUE']?>
                    </div>
                <?endif;?>
            </div>
            <button class="product-favorite js-product-favorite <?if(in_array($arResult['ID'], $arParams['FAVORITE'])):?> is-active <?endif;?>" data-id="<?=$arResult['ID']?>">
                        <span>
                          <svg class="icon icon-favorite">
                            <use xlink:href="#icon-favorite"></use>
                          </svg>
                        </span>
                Добавить в избранное
            </button>
        </div>

        <?if($arResult["CAN_BUY"]):?>
        <div class="product__actions">
            <div class="card__touchspin">
                <input type="text"
                       class="input-touchspin js-input-touchspin js-quantity js_quantity_basket_element"
                       value="1">
            </div>
            <buttton class="btn btn-primary product__basket js-product__basket js_product_basket_element"
                     data-id="<?=$arResult['ID']?>"
                     data-text="В корзине">
                        <span>
                          <svg class="icon icon-basket">
                            <use xlink:href="#icon-basket"></use>
                          </svg>
                          <svg class="icon icon-check">
                            <use xlink:href="#icon-check"></use>
                          </svg>
                        </span>
                В корзину
            </buttton>
            <a href="javascript:void(0);" class="btn btn-secondary js-buy-oneclick" data-id="<?=$arResult['ID']?>">
                Купить в 1 клик
            </a>
        </div>
        <?endif;?>
    </div>
</div>

