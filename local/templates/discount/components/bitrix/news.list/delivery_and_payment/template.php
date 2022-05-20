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
<div class="contacts__footer <?=$arParams['CLASS']?>">
	<div class="container">
		<h2>
            <?= $arResult['NAME'] ?>
		</h2>
		<div class="row">
            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
				<div class="col-lg-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="contacts__block">
						<div class="contacts__title">
                            <?= $arItem['NAME']; ?>
						</div>
                        <? if ($arItem['PROPERTIES']['LIST_WITH_PICTURES']['VALUE']) {
                            foreach ($arItem['PROPERTIES']['LIST_WITH_PICTURES']['VALUE'] as $item) { ?>
								<div class="contacts__info">
                                    <? if ($item['image']) { ?>
										<span>
	                                    <img src="<?= CFile::GetPath($item['image']) ?>" alt="<?= $item['text']; ?>"
	                                         title="<?= $item['text']; ?>">
	                                </span>
                                    <? } ?>
                                    <?= $item['text']; ?>
								</div>
                            <? } ?>
                        <? } ?>
                        <?= $arItem['~PREVIEW_TEXT']; ?>
					</div>
                    <? if ($arItem['~DETAIL_TEXT']) { ?>
						<div class="contacts__note">
                            <?= $arItem['~DETAIL_TEXT']; ?>
						</div>
                    <? } ?>
				</div>
            <? } ?>
		</div>
	</div>
</div>
