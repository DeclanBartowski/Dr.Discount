<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL",'PREVIEW_PICTURE');
$arFilter = ['IBLOCK_ID' => IBLOCK_BRANDS, 'ACTIVE'=>'Y'];
$res = CIBlockElement::GetList(['NAME' => 'ASC'], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNext()) {
    if($ob['PREVIEW_PICTURE']){
        $ob['PREVIEW_PICTURE'] = CFile::ResizeImageGet(
            $ob['PREVIEW_PICTURE'],
                             array("width" => 48, "height" => 33),
                             BX_RESIZE_IMAGE_PROPORTIONAL)['src'];
    }
    $aMenuLinks[] = [
        $ob['NAME'],
        $ob['DETAIL_PAGE_URL'],
        array(),
        array('BRAND_ICON'=>$ob['PREVIEW_PICTURE']),
        ""
    ];
}
?>
