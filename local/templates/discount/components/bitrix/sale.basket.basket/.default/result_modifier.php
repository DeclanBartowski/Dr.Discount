<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if (!empty($arResult['GRID']['ROWS'])) {
    $arElementsID = array_column($arResult['GRID']['ROWS'], 'PRODUCT_ID');
    if (!empty($arElementsID)) {
        $arProps = [];
        CModule::IncludeModule('iblock');
        $arSelect = array("ID", "IBLOCK_ID", "PROPERTY_*");
        $arFilter = array("IBLOCK_ID" => IBLOCK_CATALOG, 'ID' => $arElementsID);
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arProps[$arFields['ID']] = $arProps["LABELS"];
        }
    }
    if (!empty($arProps)) {
        foreach ($arResult['GRID']['ROWS'] as &$row) {
            $row['LABELS'] = $arProps[$row['PRODUCT_ID']];
        }
        unset($row);
    }

}