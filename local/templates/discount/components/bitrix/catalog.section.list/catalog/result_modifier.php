<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arNavChain[] = ['LINK' => '/catalog/', 'TITLE' => 'Каталог'];

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


if(!empty($arParams['CURRENT_SECTION'])) {

    $nav = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $arParams['CURRENT_SECTION'], ['NAME', 'SECTION_PAGE_URL']);
    while ($navChain = $nav->GetNext()) {
        $arNavChain[] = ['LINK' => $navChain['SECTION_PAGE_URL'], 'TITLE' => $navChain['NAME']];
    }
}

$cp = $this->__component; // объект компонента

if (is_object($cp)) {
    $cp->arResult['BREADCRUMBS'] = $arNavChain;
    $cp->SetResultCacheKeys(array('BREADCRUMBS'));
}