<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";


foreach ($arResult['ITEMS'] as $arItem) {


    if($arItem['CODE'] == 'BRAND' && !empty($arItem['VALUES'])) {


       $res =  \Bitrix\Iblock\ElementTable::getList([
            'filter' => ['IBLOCK_ID' => 5, 'ID' => array_keys($arItem['VALUES'])] ,
            'select' => ['PREVIEW_PICTURE', 'NAME', 'ID']
        ]);

       while ($brand = $res->fetch()) {
           if(!empty($brand['PREVIEW_PICTURE'])) {
               $brand['PREVIEW_PICTURE_SRC'] = CFile::GetPath($brand['PREVIEW_PICTURE']);
           }
           $arResult['BRANDS'][$brand['ID']] = $brand;
       }

    }
}

$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    // добавим в arResult компонента поля
    $cp->arResult['ITEMS'] = $arResult['ITEMS'];
    $cp->arResult['BRANDS'] = $arResult['BRANDS'];
    $cp->arResult['FORM_ACTION'] = $arResult['FORM_ACTION'];
    $cp->arResult['HIDDEN'] = $arResult['HIDDEN'];
    $cp->SetResultCacheKeys(array('ITEMS','BRANDS'));

}

