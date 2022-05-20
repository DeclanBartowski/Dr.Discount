<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    if ($arItem['PREVIEW_PICTURE']['ID']) {
        $arItem['RESIZED_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],
                    ['width' => 688, 'height' => 192],
                    BX_RESIZE_IMAGE_PROPORTIONAL
                )['src'];
    }
    $dates = explode('/', FormatDate(('d/F Y'), strtotime($arItem['DATE_ACTIVE_FROM'])));
    $arItem['DAY'] = $dates[0];
    $arItem['MY'] = $dates[1];
}
unset($arItem);