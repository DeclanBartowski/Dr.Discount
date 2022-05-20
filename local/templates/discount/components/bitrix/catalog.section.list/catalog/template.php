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

<div class="sidebar__inner">
    <div class="accordion">
        <? foreach ($arResult['MAIN_SECTIONS'] as $arSection): ?>
            <?

            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
                array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="sidebar__item">
                <div class="sidebar__header js-sidebar__header">
                    <button class="btn" type="button" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                        <?= $arSection['NAME'] ?>
                    </button>
                </div>
                <? if (!empty($arResult['SUB_SECTIONS'][$arSection['ID']])): ?>
                    <div class="collapse js-collapse">
                        <div class="sidebar__body">
                            <ul>
                                <? foreach ($arResult['SUB_SECTIONS'][$arSection['ID']] as $section): ?>
                                    <?

                                    $this->AddEditAction($section['ID'], $section['EDIT_LINK'],
                                        CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_EDIT"));
                                    $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'],
                                        CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_DELETE"),
                                        array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <li>
                                        <a href="<?= $section['SECTION_PAGE_URL'] ?>"
                                           id="<?= $this->GetEditAreaId($section['ID']); ?>">
                                            <?= $section['NAME'] ?>
                                        </a>
                                    </li>
                                <? endforeach; ?>

                            </ul>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        <? endforeach; ?>
    </div>
</div>