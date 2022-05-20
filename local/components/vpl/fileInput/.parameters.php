<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$ext = 'pdf, doc, docx';
$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"FILE_PATH" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => 'Выберите файл:',
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => $ext,
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array('text')
		),
		"TITLE" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => 'Заголовок',
			"TYPE" => "STRING",
		),
		"IMG_CLASS" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => 'Класс картинки',
			"TYPE" => "STRING",
		),
	),
);

?>
