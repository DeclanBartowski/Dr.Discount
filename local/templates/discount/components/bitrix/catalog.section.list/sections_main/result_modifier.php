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