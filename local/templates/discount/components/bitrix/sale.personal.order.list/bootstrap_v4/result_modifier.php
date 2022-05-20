<?php
/**
 * @var $arResult array;
 * @var $arParams array;
 */

foreach ($arResult['ORDERS'] as $arOrder) {
    if ($arOrder['ORDER']['CANCELED'] == 'Y') {
        $arResult['CANCELED_ORDERS'][] = $arOrder;
    } elseif (in_array($arOrder['ORDER']['STATUS_ID'], $arParams['HISTORIC_STATUSES'])) {
        $arResult['HISTORY_ORDERS'][] = $arOrder;
    } else {
        $arResult['CURRENT_ORDERS'][] = $arOrder;
    }
}
