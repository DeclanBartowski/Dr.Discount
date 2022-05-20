<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Loader;
/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;


foreach ($arResult['BREADCRUMBS'] as $breadcrumb) {
  $GLOBALS['APPLICATION']->AddChainItem($breadcrumb['TITLE'], $breadcrumb['LINK']);
}

