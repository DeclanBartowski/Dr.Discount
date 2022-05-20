<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if(!empty($arParams['FILE_PATH'])) $arResult['FILE_PATH'] = $arParams['FILE_PATH'];
if(!empty($arParams['TITLE'])) $arResult['TITLE'] = $arParams['TITLE'];


$this->IncludeComponentTemplate();
?>
