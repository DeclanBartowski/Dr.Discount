<? if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
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
        ['width' => 36, 'height' => 27],
        BX_RESIZE_IMAGE_PROPORTIONAL
    )['src'];
} else {
    $picture = CATALOG_NO_PHOTO;
}


?>
<a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="search-menu__item" id="<?= $areaId ?>">
    <span class="search-menu__icon">
        <img src="<?= $picture; ?>" alt="<?= $item['PREVIEW_PICTURE']['ALT']; ?>"
             title="<?= $item['PREVIEW_PICTURE']['TITLE']; ?>" loading="lazy">
    </span>
    <span class="search-menu__text">
        <span class="search-menu__main">
            <? if ($arParams['BRANDS_INFO'][$item['PROPERTIES']['BRAND']['VALUE']]) { ?>
                <span class="search-menu__name">
                    <?= $arParams['BRANDS_INFO'][$item['PROPERTIES']['BRAND']['VALUE']]['NAME']; ?>
                </span>
            <? } ?>
            <span class="search-menu__note">
               <?= $item['NAME']; ?>
            </span>
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
        </span>
        <span class="search-menu__prices">
            <? if ($item['MIN_PRICE']) { ?>
                <span class="search-menu__price">
                 <?= $item['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] ?>
            </span>
            <? if ($item['MIN_PRICE']['DISCOUNT_DIFF'] > 0) { ?>
                    <span class="search-menu__discount">
                <?= $item['MIN_PRICE']['PRINT_VALUE'] ?>
            </span>
                <? } ?>
            <? } else { ?>
                <span class="search-menu__price">
                           Цена по запросу
                        </span>
            <? } ?>
        </span>
    </span>
</a>