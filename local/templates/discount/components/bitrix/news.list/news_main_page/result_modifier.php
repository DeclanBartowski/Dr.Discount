<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem['TAGS'])) {
        $arItem['TAGS_ARRAY'] = explode(',', $arItem['TAGS']);
    }
    if (!empty($arItem["ACTIVE_FROM"])) {
        $timeStamp = strtotime($arItem['ACTIVE_FROM']);
        $arItem['DATE']['DAY'] = FormatDate('j', $timeStamp);
        $arItem['DATE']['MONTH_YEAR'] = strtolower(FormatDate('F Y', $timeStamp));
    }
}
unset($arItem);