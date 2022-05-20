<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($arResult["PHONE_REGISTRATION"]) {
    CJSCore::Init('phone_auth');
}
?>
<div class="container">


<div class="bx-auth account__info">
    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ?>
    <? if ($arResult["SHOW_FORM"]): ?>

		<b><?= GetMessage("AUTH_CHANGE_PASSWORD") ?></b>
		<form method="post" action="<?= $arResult["AUTH_FORM"] ?>" name="bform">
            <? if (strlen($arResult["BACKURL"]) > 0): ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <? endif ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">
            <? if ($arResult["PHONE_REGISTRATION"]): ?>
				<div class="form-group form-group-required">
					<label class="form-control-placeholder is-hide">
                        <? echo GetMessage("sys_auth_chpass_phone_number") ?>
					</label>
					<input type="text"
					       value="<?= htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"]) ?>"
					       disabled
					       placeholder="" class="form-control">
					<input type="hidden"
					       name="USER_PHONE_NUMBER"
					       value="<?= htmlspecialcharsbx($arResult["USER_PHONE_NUMBER"]) ?>"/>
				</div>
				<div class="form-group form-group-required">
					<label class="form-control-placeholder is-hide">
                        <? echo GetMessage("sys_auth_chpass_code") ?>
					</label>
					<input type="text" name="USER_CHECKWORD"
					       maxlength="50"
					       value="<?= $arResult["USER_CHECKWORD"] ?>"
					       placeholder=""
					       class="form-control">
				</div>
            <? else: ?>
				<div class="form-group form-group-required">
					<label class="form-control-placeholder is-hide">
                        <?= GetMessage("AUTH_LOGIN") ?>
					</label>
					<input type="text"
					       name="USER_LOGIN"
					       maxlength="50"
					       value="<?= $arResult["LAST_LOGIN"] ?>"
					       placeholder=""
					       class="form-control">
				</div>
				<div class="form-group form-group-required">
					<label class="form-control-placeholder is-hide">
                        <?= GetMessage("AUTH_CHECKWORD") ?>
					</label>
					<input type="text"
					       placeholder=""
					       name="USER_CHECKWORD"
					       maxlength="50"
					       value="<?= $arResult["USER_CHECKWORD"] ?>"
					       class="form-control">
				</div>
            <? endif ?>
			<div class="form-group form-group-required">
				<label class="form-control-placeholder">
                    <?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?>
				</label>
				<input type="password"
				       name="USER_PASSWORD"
				       maxlength="50"
				       value="<?= $arResult["USER_PASSWORD"] ?>"
				       placeholder=""
				       autocomplete="off"
				       class="form-control">
			</div>
			<div class="form-group form-group-required">
				<label class="form-control-placeholder">
                    <?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?>
				</label>
				<input type="password"
				       name="USER_CONFIRM_PASSWORD"
				       maxlength="50"
				       value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>"
				       placeholder=""
				       autocomplete="off"
				       class="form-control">
			</div>
            <? if ($arResult["USE_CAPTCHA"]): ?>
				<div class="form-group form-group-required">
					<label class="form-control-placeholder">
						<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
						     width="180" height="40" alt="CAPTCHA"/>
					</label>
					<input type="text"
					       name="captcha_word"
					       maxlength="50"
					       placeholder=""
					       class="form-control">
				</div>
            <? endif ?>
			<div class="btns-wrapper">
				<button type="submit" name="change_pwd" value="<?= GetMessage("AUTH_CHANGE") ?>" class="btn btn-primary">
                    <?= GetMessage("AUTH_CHANGE") ?>
				</button>
			</div>
		</form>

		<p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
		<p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>

    <? if ($arResult["PHONE_REGISTRATION"]): ?>

		<script type="text/javascript">
            new BX.PhoneAuth({
                containerId: 'bx_chpass_resend',
                errorContainerId: 'bx_chpass_error',
                interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                data:
                <?=CUtil::PhpToJSObject([
                    'signedData' => $arResult["SIGNED_DATA"]
                ])?>,
                onError:
                    function (response) {
                        var errorDiv = BX('bx_chpass_error');
                        var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
                        errorNode.innerHTML = '';
                        for (var i = 0; i < response.errors.length; i++) {
                            errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                        }
                        errorDiv.style.display = '';
                    }
            });
		</script>

		<div id="bx_chpass_error" style="display:none"><? ShowError("error") ?></div>

		<div id="bx_chpass_resend"></div>

    <? endif ?>

    <? endif ?>
	<p><a data-toggle="modal" data-target="#modalEnter"
	      href="<?= $arResult["AUTH_AUTH_URL"] ?>"><b><?= GetMessage("AUTH_AUTH") ?></b></a></p>
</div>
</div>