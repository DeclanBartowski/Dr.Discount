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
<? if (!empty($arResult['ITEMS'])): ?>
    <div class="homescreen">
        <div class="homescreen__slider js-homescreen__slider">


            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="homescreen__bg">
                        <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                            <picture>
                                <? if (!empty($arItem['DETAIL_PICTURE']['SRC'])): ?>
                                    <source srcset="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" media="(max-width: 992px)">
                                <? endif; ?>
                                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>" loading="lazy"
                                     title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>">
                            </picture>
                        <? endif; ?>
                    </div>
                    <div class="container">
                        <div class="homescreen__text">
                            <? if (!empty($arItem['PROPERTIES']['BTN']['VALUE']['BTN_LINK'])): ?>
                                <a href="<?= $arItem['PROPERTIES']['BTN']['VALUE']['BTN_LINK'] ?>"
                                   class="homescreen__title">
                                    <?= $arItem['NAME'] ?>
                                </a>

                            <? else: ?>
                                <div class="homescreen__title">
                                    <?= $arItem['NAME'] ?>
                                </div>
                            <? endif; ?>
                            <p>
                                <?= $arItem['PREVIEW_TEXT'] ?>
                            </p>
                            <? if (!empty($arItem['PROPERTIES']['BTN']['VALUE']['BTN']) && !empty($arItem['PROPERTIES']['BTN']['VALUE']['BTN_LINK'])): ?>
                                <a href="<?= $arItem['PROPERTIES']['BTN']['VALUE']['BTN_LINK'] ?>"
                                   class="btn btn-outline-primary">
                                    <?= $arItem['PROPERTIES']['BTN']['VALUE']['BTN'] ?>
                                </a>
                            <? endif; ?>
                        </div>
                    </div>
                </div>

            <? endforeach; ?>
        </div>
        <div class="homescreen__nav">
            <div class="container">
                <button class="homescreen__btn homescreen__prev js-homescreen__prev">
                    <svg class="icon icon-prev">
                        <use xlink:href="#icon-prev"></use>
                    </svg>
                </button>
                <button class="homescreen__btn homescreen__next js-homescreen__next">
                    <svg class="icon icon-next">
                        <use xlink:href="#icon-next"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<? endif; ?>