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
<div class="producers">
    <div class="container">
        <div class="page-heading">
            <h2>
                <?= $arResult['NAME'] ?>
            </h2>
            <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn btn-outline-secondary">
                <?= GetMessage('ALL_BRANDS') ?>
            </a>
            <div class="btn-wrap">
                <button class="slick__btn slick__prev js-producers__prev">
                    <svg class="icon icon-prev">
                        <use xlink:href="#icon-prev"></use>
                    </svg>
                </button>
                <button class="slick__btn slick__next js-producers__next">
                    <svg class="icon icon-next">
                        <use xlink:href="#icon-next"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="producers__slider js-producers__slider">
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
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="producers__item">
                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             alt="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>" loading="lazy">
                    </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>