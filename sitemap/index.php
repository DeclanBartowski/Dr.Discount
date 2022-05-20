<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
echo ' <div class="section"><div class="container"><div class="row justify-content-center"><div class="col-12 col-lg-10">';
?><?$APPLICATION->IncludeComponent("bitrix:main.map", "sitemap", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COL_NUM" => "2",	// Количество колонок
		"LEVEL" => "3",	// Максимальный уровень вложенности (0 - без вложенности)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_DESCRIPTION" => "N",	// Показывать описания
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?

echo '</div></div></div></div>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>