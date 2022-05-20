<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Loader;
/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if (!$this->__template) {
    $this->InitComponentTemplate();
}

if (!empty($arResult['DETAIL_TEXT']) || !empty($arResult['TC'])) {
    $this->__template->SetViewTarget('detail_text');
    ?>
    <div class="characteristics">
        <div class="container">
            <div class="characteristics__wp">
                <? if (!empty($arResult['DETAIL_TEXT'])): ?>
                    <div class="characteristics__item"><?= $arResult['DETAIL_TEXT'] ?></div>
                <? endif; ?>
                <? if (!empty($arResult['TC'])): ?>
                    <div class="characteristics__item">
                        <div class="characteristics__title">
                            <?=\Bitrix\Main\Localization\Loc::getMessage('TECHNICAL_TITLE')?>
                        </div>
                        <ul>
                            <? foreach ($arResult['TC'] as $item): ?>
                                <li><?=$item?></li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                <? endif; ?>
            </div>
            <a href="/catalog/" class="btn btn-outline-primary btn-arrow">
                <?=\Bitrix\Main\Localization\Loc::getMessage('CATALOG_PRODUCTION_TITLE')?>
            </a>
        </div>
    </div>

    <?php
    $this->__template->EndViewTarget();
}