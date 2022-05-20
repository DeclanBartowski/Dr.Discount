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
if ($arResult['ITEMS']) {
    ?>
	<div class="reviews">
		<div class="container">
			<div class="page-heading">
				<h2><?= $arResult['NAME']; ?></h2>
                <?
                if (count($arResult['ITEMS']) > 4) { ?>
					<div class="btn-wrap">
						<button class="slick__btn slick__prev js-reviews__prev">
							<svg class="icon icon-prev">
								<use xlink:href="#icon-prev"></use>
							</svg>
						</button>
						<button class="slick__btn slick__next js-reviews__next">
							<svg class="icon icon-next">
								<use xlink:href="#icon-next"></use>
							</svg>
						</button>
					</div>
                <?
                } ?>
			</div>
			<div class="reviews__slider js-reviews__slider">
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
                    $picture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],
                        ['width' => 147, 'height' => 209],
                        BX_RESIZE_IMAGE_PROPORTIONAL
                    )['src'];
                    ?>
					<div class="" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<a href="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" data-fancybox="review"
						   class="reviews__slide">
                        <span class="reviews__img">
                            <img src="<?= $picture; ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT']; ?>"
                                 title="<?= $arItem['PREVIEW_PICTURE']['TITLE']; ?>">
                        </span>
                            <?= $arItem['NAME'] ?>
						</a>
					</div>
                <? endforeach; ?>
			</div>
		</div>
	</div>
    <?
}
?>
