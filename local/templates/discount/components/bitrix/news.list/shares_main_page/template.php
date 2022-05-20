<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="sale-block">
    <div class="container">
        <div class="page-heading">
            <h2>
                <?= $arResult['NAME'] ?>
            </h2>
            <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn btn-outline-secondary">
                <?= GetMessage('SHARES_ALL') ?>
            </a>
            <div class="btn-wrap">
                <button class="slick__btn slick__prev js-sale-block__prev">
                    <svg class="icon icon-prev">
                        <use xlink:href="#icon-prev"></use>
                    </svg>
                </button>
                <button class="slick__btn slick__next js-sale-block__next">
                    <svg class="icon icon-next">
                        <use xlink:href="#icon-next"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="sale-block__slider js-sale-block__slider">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if (empty($arItem['PREVIEW_PICTURE']['SRC'])) {
                continue;
            }
            ?>
            <div class="" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="sale-item">
                    <span class="sale-img">
                        <?if(!empty($arItem['DATE'])):?>
                        <span class="sale-data">
                            <small><?=GetMessage('TIME_TO')?></small>
                            <b>
                                  <?=$arItem['DATE']['DAY']?>
                            </b>
                            <?=$arItem['DATE']['MONTH_YEAR']?>
                        </span>
                        <?endif;?>
                        <span class="sale-img__wrap">
                                 <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" loading="lazy" class="svg-clipped">
                        </span>
                    </span>

                    <span class="sale-text">
                        <span class="sale-text__title"><?=$arItem['NAME']?></span>
                        <span class="sale-note"><?=$arItem['PREVIEW_TEXT']?></span>
                    </span>
                </a>
            </div>
            <? endforeach; ?>

        </div>
    </div>
</div>