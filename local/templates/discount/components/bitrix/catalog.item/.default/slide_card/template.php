<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
if ($item['PREVIEW_PICTURE']['ID']) {
    $picture = CFile::ResizeImageGet($item['PREVIEW_PICTURE']['ID'],
        ['width' => 210, 'height' => 168],
        BX_RESIZE_IMAGE_PROPORTIONAL
    )['src'];
} else {
    $picture = CATALOG_NO_PHOTO;
}

?>


<div class="others__slide" id="<?= $areaId ?>">
	<div class="card js-card">
		<a class="card__img" href="=<?=$item['DETAIL_PAGE_URL']?>">
			<img src="<?= $picture; ?>" alt="<?= $item['PREVIEW_PICTURE']['ALT']; ?>"
			     title="<?= $item['PREVIEW_PICTURE']['TITLE']; ?>" loading="lazy">
		</a>
		<div class="card__text">
			<div class="card__info">
				<div class="card__main">
                    <? if ($arParams['BRANDS_INFO'][$item['PROPERTIES']['BRAND']['VALUE']]) { ?>
						<a href="<?= $arParams['BRANDS_INFO'][$item['PROPERTIES']['BRAND']['VALUE']]['DETAIL_PAGE_URL'] ?: 'javascript:void(0)' ?>"
						   class="card__brand" target="_blank">
                            <?= $arParams['BRANDS_INFO'][$item['PROPERTIES']['BRAND']['VALUE']]['NAME']; ?>
						</a>
                    <? } ?>
					<a href="<?= $item['DETAIL_PAGE_URL']; ?>" class="card__name">
                        <?= $item['NAME']; ?>
					</a>
                    <? if ($item['PROPERTIES']['LABELS']['VALUE']) { ?>
						<div class="tags">
							<?foreach ($item['PROPERTIES']['LABELS']['VALUE'] as $key => $label) {
								$icons = explode('/', $item['PROPERTIES']['LABELS']['VALUE_XML_ID'][$key]);
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
				</div>
				<div class="card__prices">
					<div class="card__price">
                        <?= $item['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] ?>
					</div>
                    <? if ($item['MIN_PRICE']['DISCOUNT_DIFF'] > 0) { ?>
						<div class="card__discount">
                            <?= $item['MIN_PRICE']['PRINT_VALUE'] ?>
						</div>
                    <? } ?>
				</div>
			</div>
			<div class="card__footer">
				<div class="card__wrap">
					<div class="card__touchspin">
						<input type="text"
						       class="input-touchspin js-input-touchspin js_quantity_item"
						       value="1">
					</div>
					<button class="add-basket js-add-basket js_add_item" data-id="<?=$item['ID']?>">
						<svg class="icon icon-basket">
							<use xlink:href="#icon-basket"></use>
						</svg>
					</button>
					<button class="add-favorite js-add-favorite js-product-favorite">
						<svg class="icon icon-favorite">
							<use xlink:href="#icon-favorite"></use>
						</svg>
					</button>
				</div>
				<a href="javascript:void(0);" class="card__buy js-buy-oneclick" data-id="<?=$item['ID']?>">
					Купить в 1 клик
				</a>
			</div>
		</div>
	</div>
</div>