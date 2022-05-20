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

$lastSection[] = array_pop($arResult['MAIN_SECTIONS']);
?>
<div class="footer__menus">


    <? foreach ($arResult['MAIN_SECTIONS'] as $arSection): ?>
        <ul>
            <?
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
                array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                    <?= $arSection['NAME'] ?>
                </a>
            </li>

            <? foreach ($arResult['SUB_SECTIONS'][$arSection['ID']] as $section): ?>
                <?
                $this->AddEditAction($section['ID'], $section['EDIT_LINK'],
                    CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_EDIT"));
                $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'],
                    CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li id="<?= $this->GetEditAreaId($section['ID']); ?>">
                    <a href="<?= $section['SECTION_PAGE_URL'] ?>">
                        <?= $section['NAME'] ?>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    <? endforeach; ?>



    <? if (!empty($arResult['BRANDS'])): ?>
        <ul>
            <? foreach ($arResult['BRANDS'] as $item): ?>
                <li><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a></li>
            <? endforeach; ?>
        </ul>

    <? endif; ?>

    <ul>

        <? foreach ($lastSection as $arSection): ?>
            <?
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
                CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
                array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                    <?= $arSection['NAME'] ?>
                </a>
            </li>

            <? foreach ($arResult['SUB_SECTIONS'][$arSection['ID']] as $section): ?>
                <?
                $this->AddEditAction($section['ID'], $section['EDIT_LINK'],
                    CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_EDIT"));
                $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'],
                    CIBlock::GetArrayByID($section["IBLOCK_ID"], "SECTION_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li id="<?= $this->GetEditAreaId($section['ID']); ?>">
                    <a href="<?= $section['SECTION_PAGE_URL'] ?>">
                        <?= $section['NAME'] ?>
                    </a>
                </li>
            <? endforeach; ?>

        <? endforeach; ?>
    </ul>
</div>
