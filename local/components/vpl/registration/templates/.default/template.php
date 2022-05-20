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
<form id="modal-reg-form">
	<div class="tq-component-result">
        <?if(!empty($arResult['ERRORS'])){?>
            <div class="error"><?=$arResult['ERRORS']?></div>
        <?}?>
	</div>

<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		Представьтесь
	</label>
	<input type="text" name="name" placeholder="" class="form-control">
</div>
<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		E-mail
	</label>
	<input type="email" name="email" placeholder="" class="form-control">
</div>
<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		Телефон
	</label>
	<input type="tel" name="phone" placeholder="" class="form-control">
</div>
<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		Введите пароль
	</label>
	<input type="password" name="password" placeholder="" class="form-control">
</div>
<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		Подтвердите пароль
	</label>
	<input type="password" name="password_confirm" placeholder="" class="form-control">
</div>
<div class="form-group form-group-required">
	<label class="form-control-placeholder">
		Ваше сообщение
	</label>
	<textarea name="note" class="form-control"></textarea>
</div>

<div class="captcha">
	<?/*
	<div class="g-recaptcha" data-sitekey="6Ldp9rwZAAAAACFWMQo8tc_8nm1QJBspOuGaMWhr"></div>
	*/?>
	<input type="hidden" id="registerCaptchaSid" name="captcha_sid" value="<?=$arResult["capCode"]?>">
	<img id="registerCaptchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA" title="CAPTCHA" loading="lazy">
	<input type="text" name="captcha_word" size="30" maxlength="50" value="">
</div>

<div class="modal-btn">
	<button type="submit" class="btn btn-primary">
		Зарегистрироваться
	</button>
</div>
<div class="form-group">
	<div class="custom-control custom-checkbox">
		<input type="checkbox" checked class="custom-control-input"
		       id="modal-register" required>
		<label class="custom-control-label"
		       for="modal-register">Нажимая кнопку «Отправить»,
			я даю свое <a href="/politika-konfidentsialnosti/">согласие на обработку моих персональных
				данных</a>, в
			соответствии с Федеральным законом от 27.07.2006 года
			№152-ФЗ</label>
	</div>
</div>
</form>


