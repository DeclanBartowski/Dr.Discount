<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
?>

<h6>
    <?=Loc::getMessage('TITLE_PAGES')?>
</h6>


<?
ShowError($arResult["strProfileError"]);

if ($arResult['DATA_SAVED'] == 'Y') {
    ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
}

?>
<form method="post" name="form1" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data" role="form">
    <?= $arResult["BX_SESSION_CHECK"] ?>
    <input type="hidden" name="lang" value="<?= LANG ?>"/>
    <input type="hidden" name="ID" value="<?= $arResult["ID"] ?>"/>
    <input type="hidden" name="LOGIN" value="<?= $arResult["arUser"]["LOGIN"] ?>"/>
    <div class="account__info" id="user_div_reg">

        <div class="account__update">

            <?
            if ($arResult["ID"] > 0) {
                if ($arResult["arUser"]["TIMESTAMP_X"] <> '') {
                    ?>
                    <p><?= Loc::getMessage('LAST_UPDATE') ?> <?= $arResult["arUser"]["TIMESTAMP_X"] ?></p>
                    <?
                }

                if ($arResult["arUser"]["LAST_LOGIN"] <> '') {
                    ?>

                    <p><?= Loc::getMessage('LAST_LOGIN') ?> <?= $arResult["arUser"]["LAST_LOGIN"] ?></p>

                    <?
                }
            }
            ?>

        </div>

        <?
        if (!in_array(LANGUAGE_ID, array('ru', 'ua'))) {
            ?>
            <div class="row">
                <div class="col align-items-center">
                    <div class="form-group">
                        <label class="main-profile-form-label"
                               for="main-profile-title"><?= Loc::getMessage('main_profile_title') ?></label>
                        <input class="form-control" type="text" name="TITLE" maxlength="50" id="main-profile-title"
                               value="<?= $arResult["arUser"]["TITLE"] ?>"/>
                    </div>
                </div>
            </div>
            <?
        }
        ?>
        <div class="form-group form-group-required">
            <label class="form-control-placeholder <? if (!empty($arResult["arUser"]["NAME"])): ?> is-hide <? endif; ?>"
                   for="main-profile-name"><?= Loc::getMessage('NAME') ?></label>
            <input class="form-control" type="text" name="NAME" maxlength="50" id="main-profile-name"
                   value="<?= $arResult["arUser"]["NAME"] ?>"/>
        </div>

        <div class="form-group form-group-required">
            <label class="form-control-placeholder <? if (!empty($arResult["arUser"]["LAST_NAME"])): ?>is-hide<? endif; ?>"
                   for="main-profile-last-name"><?= Loc::getMessage('LAST_NAME') ?></label>
            <input class="form-control" type="text" name="LAST_NAME" maxlength="50" id="main-profile-last-name"
                   value="<?= $arResult["arUser"]["LAST_NAME"] ?>"/>
        </div>
        <div class="form-group form-group-required">
            <label class="form-control-placeholder <? if (!empty($arResult["arUser"]["SECOND_NAME"])): ?>is-hide<? endif; ?>"
                   for="main-profile-second-name"><?= Loc::getMessage('SECOND_NAME') ?></label>
            <input class="form-control" type="text" name="SECOND_NAME" maxlength="50" id="main-profile-second-name"
                   value="<?= $arResult["arUser"]["SECOND_NAME"] ?>"/>
        </div>
        <div class="form-group form-group-required">
            <label class="form-control-placeholder <? if (!empty($arResult["arUser"]["EMAIL"])): ?>is-hide<? endif; ?>"
                   for="main-profile-email"><?= Loc::getMessage('EMAIL') ?></label>
            <input class="form-control" type="text" name="EMAIL" maxlength="50" id="main-profile-email"
                   value="<?= $arResult["arUser"]["EMAIL"] ?>"/>
        </div>


        <?
        if ($arResult['CAN_EDIT_PASSWORD']) {
            ?>


            <div class="account__note">
                <? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?>
            </div>


            <div class="form-group form-group-required">
                <label class="form-control-placeholder"
                       for="main-profile-password"><?= Loc::getMessage('NEW_PASSWORD_REQ') ?></label>
                <input class="form-control" type="password" name="NEW_PASSWORD" maxlength="50"
                       id="main-profile-password" value="" autocomplete="off"/>
            </div>

            <div class="form-group form-group-required">

                <label class="form-control-placeholder"
                       for="main-profile-password-confirm"><?= Loc::getMessage('NEW_PASSWORD_CONFIRM') ?></label>
                <input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value=""
                       id="main-profile-password-confirm" autocomplete="off"/>

            </div>
            <?
        } ?>


        <div class="btns-wrapper">
            <button type="submit"
                    value="<?= (($arResult["ID"] > 0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD")) ?>"
                    name="save" class="btn btn-primary">
                <?= (($arResult["ID"] > 0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD")) ?>
            </button>
            <button class="btn btn-secondary" name="reset" value="<? echo GetMessage("MAIN_RESET") ?>">
                <? echo GetMessage("MAIN_RESET") ?>
            </button>
        </div>


    </div>

</form>

<div class="clearfix"></div>
<script>
    BX.Sale.PrivateProfileComponent.init();
</script>
