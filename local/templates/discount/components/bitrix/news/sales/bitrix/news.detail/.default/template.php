<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="sale">
	<div class="sale__data">
		<div class="sale__data-wrap">
			Акция действует до: <span><?= $arResult['FINISH_DATE'];?></span>
		</div>
	</div>
	<?if ($arResult['RESIZED_PICTURE']) {
		?>
		<div class="sale__img">
			<img src="<?= $arResult['RESIZED_PICTURE']?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'];?>" title="<?= $arResult['DETAIL_PICTURE']['TITLE'];?>">
		</div>
	<?}?>
	<div class="sale__text">
		<?= $arResult['~DETAIL_TEXT'];?>
	</div>
</div>