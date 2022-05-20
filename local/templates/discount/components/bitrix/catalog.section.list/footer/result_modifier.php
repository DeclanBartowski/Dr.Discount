<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['SECTIONS'] as $arSection) {
    if (!empty($arSection['UF_SVG'])) {
        $arSection['UF_SVG_SRC'] = CFile::GetPath($arSection['UF_SVG']);
    }
    if (empty($arSection['IBLOCK_SECTION_ID'])) {
        $arResult['MAIN_SECTIONS'][] = $arSection;
    } else {
        $arResult['SUB_SECTIONS'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
    }
}


$iBlock = CIBlock::GetByID(5)->Fetch();
$arResult['BRANDS'][] = ['DETAIL_PAGE_URL' => $iBlock['LIST_PAGE_URL'], 'NAME' => $iBlock['NAME']];
$arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = array("IBLOCK_ID" => 5, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNext()) {
    $arResult['BRANDS'][] = $ob;
}