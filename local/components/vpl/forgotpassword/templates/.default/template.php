<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Page\Asset;
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var array $arResult */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */ ?>

<form method="POST" id="forgot-form" >
	<div class="tq-component-result">
        <? if (!empty($arResult['ERRORS'])) { ?>
			<div class="error"><?= $arResult['ERRORS'] ?></div>
        <? } ?>
	</div>

	<div class="form-group form-group-required">
		<label class="form-control-placeholder">
			Введите свой e-mail
		</label>
		<input type="email" name="email" placeholder="" class="form-control">
	</div>

	<button type="submit" class="btn btn-primary">
		Восстановить
	</button>
</form>
