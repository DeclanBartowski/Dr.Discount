<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as $arItem) {
    if ($arItem['PROPERTIES']['BRAND']['VALUE']) {
        $brands[$arItem['PROPERTIES']['BRAND']['VALUE']] = $arItem['PROPERTIES']['BRAND']['VALUE'];
    }
}

if ($brands) {
    $arSelect = Array("ID", "NAME", "PROPERTY_URL", 'DETAIL_PAGE_URL');
    $arFilter = Array("IBLOCK_ID" => IBLOCK_BRANDS, "ID" => $brands, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNext()) {
        $arResult['BRANDS_INFO'][$ob['ID']] = $ob;
    }
}