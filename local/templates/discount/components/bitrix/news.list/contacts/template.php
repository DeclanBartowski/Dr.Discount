<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
	<div class="contacts__wrapper">
        <? if ($arResult['PICTURE']) {
        	$picture = CFile::ResizeImageGet($arResult['PICTURE'],
        	            ['width' => 595, 'height' => 503],
        	            BX_RESIZE_IMAGE_PROPORTIONAL
        	        )['src'];
        	?>
			<div class="contacts__img">
				<img src="<?= $picture;?>" alt="Контакты" title="Контакты">
			</div>
        <? } ?>
		<div class="contacts__map">
			<div class="map" id="map"></div>
		</div>
	</div>
<? if ($arResult['DESCRIPTION']) { ?>
	<h2>
        <?= $arResult['DESCRIPTION']; ?>
	</h2>
<? } ?>
<script>
	var SITE_TEMPLATE_PATH = <?= CUtil::PhpToJSObject(SITE_TEMPLATE_PATH);?>;
	var contactsData = {};
</script>

<?foreach ($arResult['ITEMS'] as $key => $arItem) {
	?>
	<script>
        contactsData[<?= $key;?>] = {
            'name': '<?= $arItem['NAME'];?>',
            'address': '<?= $arItem['PROPERTIES']['ADDRESS']['VALUE'];?>',
            'email': '<?= $arItem['PROPERTIES']['EMAIL']['VALUE'];?>',
            'phone': '<?= $arItem['PROPERTIES']['PHONE']['VALUE'];?>',
            'work_time': '<?= $arItem['PROPERTIES']['WORK_TIME']['VALUE'];?>',
            'coordinates': '<?= $arItem['PROPERTIES']['COORDINATES']['VALUE'];?>',
        };
	</script>
	<?
}?>
