<?

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?= $arResult["FORM_HEADER"] ?>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Написать нам</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">
                      <svg class="icon icon-close">
                        <use xlink:href="#icon-close"></use>
                      </svg>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
                <div style="color: green"><?= $arResult["FORM_NOTE"] ?></div>
                <?
                foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                    if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                        echo $arQuestion["HTML_CODE"];
                    } else {
                        switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
                            case 'text':
                            case 'email':
                                ?>
                                <div class="form-group <? if ($arQuestion['REQUIRED'] == 'Y') {
                                    ?>form-group-required<?
                                } ?>">
                                    <label class="form-control-placeholder">
                                        <?= $arQuestion["CAPTION"] ?>
                                    </label>
                                    <?
                                    $type = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
                                    if ($arQuestion["CAPTION"] == 'Телефон') {
                                        $type = 'tel';
                                    }
                                    ?>
                                    <input <? if ($arQuestion['REQUIRED'] == 'Y') {?>required<?}?> type="<?= $type ?>" placeholder="" class="form-control"
                                           name="form_<?= $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] ?>_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>">
                                </div>
                                <? break;
                            case 'textarea':
                                ?>
                                <div class="form-group <? if ($arQuestion['REQUIRED'] == 'Y') {
                                    ?>form-group-required<?
                                } ?>">
                                    <label class="form-control-placeholder">
                                        <?= $arQuestion["CAPTION"] ?>
                                    </label>
                                    <textarea <? if ($arQuestion['REQUIRED'] == 'Y') {?>required<?}?> class="form-control" name="form_<?= $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] ?>_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"></textarea>
                                </div>
                                <? break;
                        }
                        ?>
                        <?
                    }
                } //endwhile
                ?>
                <?
                if ($arResult["isUseCaptcha"] == "Y") {
                    ?>
                    <div class="captcha">
                        <input type="hidden" name="captcha_sid"
                               value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/><img
                                src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
                                width="180" height="40"/></td>
                        <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
                    </div>
                    <?
                } // isUseCaptcha
                ?>
                <!--<div class="captcha">
                    <div class="g-recaptcha"
                         data-sitekey="6Ldp9rwZAAAAACFWMQo8tc_8nm1QJBspOuGaMWhr"></div>
                </div>-->

                <div class="modal-btn">
                    <input type="hidden" name="web_form_submit" value="Отправить">
                    <button type="submit" class="btn btn-primary">
                        Отправить
                    </button>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" checked class="custom-control-input"
                               id="modal-send" required>
                        <label class="custom-control-label"
                               for="modal-send">Нажимая кнопку «Отправить»,
                            я даю свое <a href="/politika-konfidentsialnosti/">согласие на обработку моих персональных
                                данных</a>, в
                            соответствии с Федеральным законом от 27.07.2006 года
                            №152-ФЗ</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $arResult["FORM_FOOTER"] ?>

<? if ($arResult["isFormErrors"] == "Y" || strlen($arResult["FORM_NOTE"]) > 0) { ?>
    <script>
        $('#modalSend').modal('show');
    </script>
<? } ?>