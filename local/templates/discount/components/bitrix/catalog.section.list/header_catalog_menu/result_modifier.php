<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['SECTIONS'] as $arSection) {
    if (empty($arSection['IBLOCK_SECTION_ID'])) {
        $arResult['MAIN_SECTIONS'][] = $arSection;
    } else {
        $arResult['SUB_SECTIONS'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
    }
}

$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", 'PROPERTY_URL','DETAIL_PAGE_URL');
$arFilter = Array("IBLOCK_ID"=>IBLOCK_BRANDS, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext())
{
    $ob['PICTURE'] = CFile::ResizeImageGet($ob['PREVIEW_PICTURE'],
                ['width' => 59, 'height' => 37],
                BX_RESIZE_IMAGE_PROPORTIONAL
            )['src'];
    $arResult['BRANDS'][] = $ob;
}