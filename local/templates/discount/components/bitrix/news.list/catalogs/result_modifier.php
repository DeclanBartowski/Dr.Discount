<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$res = CIBlockSection::GetTreeList([
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
], ['DESCRIPTION', 'PICTURE', 'IBLOCK_SECTION_ID', 'IBLOCK_ID', 'NAME', 'ID']);

while ($arSection = $res->Fetch()) {
    if (!empty($arSection['PICTURE'])) {
        $arSection['PICTURE_SRC'] = CFile::GetPath($arSection['PICTURE']);
    }
    if (!empty($arSection['IBLOCK_SECTION_ID'])) {
        $arResult['SECTIONS_SUB'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
    } else {
        $arResult['SECTIONS_MAIN'][] = $arSection;
    }
}

$arResult['SECTIONS_ITEMS'] = [];

foreach ($arResult['ITEMS'] as $arItem) {
    $arItem['FILE'] = CFile::GetByID($arItem['PROPERTIES']['FILE']['VALUE'])->Fetch();
    $arItem['FILE']['SRC'] = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
    $arItem['FILE']['SIZE'] =  CFile::FormatSize($arItem['FILE']['FILE_SIZE']);
    $arResult['SECTIONS_ITEMS'][$arItem['IBLOCK_SECTION_ID']][] = $arItem;
}
