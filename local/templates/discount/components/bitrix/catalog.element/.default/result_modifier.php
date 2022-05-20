<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$cp = $this->__component; // объект компонента
if (is_object($cp)) {
    $cp->arResult['TC'] = $arResult['PROPERTIES']["TECHICAL_CHARECTER"]['VALUE'];
    $cp->arResult['DETAIL_TEXT'] = $arResult['DETAIL_TEXT'];
    $cp->SetResultCacheKeys(array('TC', 'DETAIL_TEXT'));
}


if(!empty($arResult['PROPERTIES']["BRAND"]['VALUE'])) {
    $arResult['BRANDS'] = CIBlockElement::GetByID($arResult['PROPERTIES']["BRAND"]['VALUE'])->GetNext();
}