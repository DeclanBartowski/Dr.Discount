<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    if ($arItem['PREVIEW_PICTURE']['ID']) {
        $arItem['RESIZED_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],
                    ['width' => 245, 'height' => 245],
                    BX_RESIZE_IMAGE_PROPORTIONAL
                )['src'];
    }
    $dates = explode('/', FormatDate(('d/F Y'), strtotime($arItem['DATE_ACTIVE_TO'])));
    $arItem['FINISH_DAY'] = $dates[0];
    $arItem['FINISH_MY'] = $dates[1];
}
unset($arItem);