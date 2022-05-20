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

<div class="news-block">
    <div class="container">
        <div class="page-heading">
            <h2>
                <?= $arResult['NAME'] ?>
            </h2>
            <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn btn-outline-secondary">
                <?= GetMessage('ALL_NEWS') ?>
            </a>
            <div class="btn-wrap">
                <button class="slick__btn slick__prev js-news-block__prev">
                    <svg class="icon icon-prev">
                        <use xlink:href="#icon-prev"></use>
                    </svg>
                </button>
                <button class="slick__btn slick__next js-news-block__next">
                    <svg class="icon icon-next">
                        <use xlink:href="#icon-next"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="news-block__slider js-news-block__slider">
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
                    <div class="news-block__item">
                        <? if (!empty($arItem['TAGS_ARRAY'])): ?>
                            <span class="news-block__tags">
                               <? foreach ($arItem['TAGS_ARRAY'] as $tag): ?>
                                   <a href="<?=sprintf('/news/?tag=%s', $tag)?>" class="news-block__tag">
                                        <?=$tag?>
                                    </a>
                               <? endforeach; ?>
                            </span>
                        <? endif; ?>
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news-block__text">
                                <? if (!empty($arItem['DATE'])): ?>
                                    <span class="news-block__data"><b><?= $arItem['DATE']['DAY'] ?></b><?= $arItem['DATE']['MONTH_YEAR'] ?></span>
                                <? endif; ?>
                                <span class="news-block__info">
                                    <span class="news-block__title"><?= $arItem['NAME'] ?></span>
                                    <span class="news-block__note"><?= $arItem['PREVIEW_TEXT'] ?></span>
                                </span>
                            </a>
                        <span class="news-block__img">
                            <? if (!empty($arItem['PREVIEW_PICTURE']['SRC'])): ?>
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="news-block__bg">
                                    <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                         alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>"
                                         title="<?= $arItem['PREVIEW_PICTURE']['TITLE'] ?>" loading="lazy">
                                </a>
                            <? endif; ?>
                        </span>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>