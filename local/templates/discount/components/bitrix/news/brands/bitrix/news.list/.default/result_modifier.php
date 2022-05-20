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
}
unset($arItem);