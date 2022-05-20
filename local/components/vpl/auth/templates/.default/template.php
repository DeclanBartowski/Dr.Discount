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
/** @var CBitrixComponent $component */

?>

<form method="POST" id="login-form">
	<div class="tq-component-result">
        <? if (!empty($arResult['ERRORS'])) { ?>
			<div class="error"><?= $arResult['ERRORS'] ?></div>
        <? } ?>
	</div>

	<div class="form-group form-group-required">
		<label class="form-control-placeholder">Логин</label>
		<input type="text" name="LOGIN" placeholder="" class="form-control">
	</div>
	<div class="form-group form-group-required">
		<label class="form-control-placeholder">Пароль</label>
		<input type="password" name="PASSWORD" placeholder="" class="form-control">
	</div>
	<div class="modal-links">
		<a data-dismiss="modal" data-toggle="modal" data-target="#modalEmail" href="#">Забыли пароль</a>
		<a data-dismiss="modal" data-toggle="modal" data-target="#modalRegister" href="#">Регистрация</a>
	</div>
	<button type="submit" class="btn btn-primary">Войти</button>
</form>
