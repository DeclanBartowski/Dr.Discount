<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem["DATE_ACTIVE_TO"])) {
        $timeStamp = strtotime($arItem['DATE_ACTIVE_TO']);
        $arItem['DATE']['DAY'] = FormatDate('j', $timeStamp);
        $arItem['DATE']['MONTH_YEAR'] = strtolower(FormatDate('F Y', $timeStamp));
    }
}
unset($arItem);