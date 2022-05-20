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
<div class="sales">
	<div class="row">
        <? foreach ($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
			<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="brand-item col-3 col-xs-12"
			   id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <!--<span class="sale-img">
	                <?/* if ($arItem['RESIZED_PICTURE']) { */?>
		                <span class="sale-img__wrap">
                        <img src="<?/*= $arItem['RESIZED_PICTURE']; */?>" alt="<?/*= $arItem['PREVIEW_PICTURE']['ALT'] */?>"
                             title="<?/*= $arItem['PREVIEW_PICTURE']['TITLE'] */?>" loading="lazy">
                    </span>
                    <?/* } */?>
                </span>-->
				<span class="sale-text">
                    <span class="sale-text__title">
                        <?= $arItem['NAME']; ?>
                    </span>
                </span>
			</a>
        <? endforeach; ?>
	</div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>
