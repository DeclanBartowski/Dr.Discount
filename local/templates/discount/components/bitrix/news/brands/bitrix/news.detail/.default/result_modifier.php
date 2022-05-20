<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['FINISH_DATE'] = FormatDate(('d F Y'), strtotime($arResult['DATE_ACTIVE_TO']));
$arResult['RESIZED_PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],
    ['width' => 1212, 'height' => 583],
    BX_RESIZE_IMAGE_PROPORTIONAL
)['src'];
