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
if ($arResult['ITEMS']) {
    ?>
	<div class="contacts__block">
		<div class="contacts__title">
            <?= $arResult['NAME']; ?>
		</div>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
			<div class="contacts__info" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? if ($arItem['PROPERTIES']['ICON']['VALUE']) { ?>
					<span>
						<img src="<?= CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']); ?>"
						     alt="<?= $arItem['NAME']; ?>" title="<?= $arItem['NAME']; ?>">
					</span>
                <? } ?>
                <?= $arItem['NAME']; ?>
			</div>
        <? endforeach; ?>
	</div>
    <?
}
?>

