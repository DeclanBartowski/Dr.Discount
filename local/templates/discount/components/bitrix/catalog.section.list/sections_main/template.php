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
<div class="catalog-block">
    <div class="container">
        <div class="page-heading">
            <h2>
                <?=GetMessage('TITLE_SECTIONS')?>
            </h2>
            <a href="/catalog/" class="btn btn-outline-secondary">
                <?=GetMessage('ALL_SECTIONS')?>
            </a>
        </div>
        <div class="catalog-block__wp">
            <? foreach ($arResult['MAIN_SECTIONS'] as $arSection): ?>
                <?

                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
                    CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
                    CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));


                ?>
                <div class="catalog-block__item js-catalog-block__item">
                    <? if (!empty($arSection['UF_SVG_SRC'])): ?>
                        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="catalog-block__icon">
                            <img src="<?= $arSection['UF_SVG_SRC'] ?>" alt="<?= $arSection['NAME'] ?>"
                                 title="<?= $arSection['NAME'] ?>" loading="lazy">
                        </a>
                    <? endif; ?>
                    <div class="catalog-block__text" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                        <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="catalog-block__title">
                            <?= $arSection['NAME'] ?>
                        </a>
                    </div>
                    <? if (!empty($arResult['SUB_SECTIONS'][$arSection['ID']])): ?>
                        <?
                        $chunk = array_chunk($arResult['SUB_SECTIONS'][$arSection['ID']], 4);
                        $visible = array_shift($chunk);
                        ?>
                        <div class="catalog-block__wrap">
                            <ul class="catalog-block__list">
                                <? foreach ($visible as $visibleItem): ?>
                                    <?

                                    $this->AddEditAction($visibleItem['ID'], $visibleItem['EDIT_LINK'],
                                        CIBlock::GetArrayByID($visibleItem["IBLOCK_ID"], "SECTION_EDIT"));
                                    $this->AddDeleteAction($visibleItem['ID'], $visibleItem['DELETE_LINK'],
                                        CIBlock::GetArrayByID($visibleItem["IBLOCK_ID"], "SECTION_DELETE"),
                                        array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <li id="<?= $this->GetEditAreaId($visibleItem['ID']); ?>">
                                        <a href="<?= $visibleItem['SECTION_PAGE_URL'] ?>">
                                            <?= $visibleItem['NAME'] ?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                            <? if (!empty($chunk)): ?>

                                <ul class="catalog-block__list js-catalog-block__list hidden">
                                    <? foreach ($chunk as $arChunk): ?>
                                        <? foreach ($arChunk as $visibleItem): ?>
                                            <?

                                            $this->AddEditAction($visibleItem['ID'], $visibleItem['EDIT_LINK'],
                                                CIBlock::GetArrayByID($visibleItem["IBLOCK_ID"], "SECTION_EDIT"));
                                            $this->AddDeleteAction($visibleItem['ID'], $visibleItem['DELETE_LINK'],
                                                CIBlock::GetArrayByID($visibleItem["IBLOCK_ID"], "SECTION_DELETE"),
                                                array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                                            ?>
                                            <li id="<?= $this->GetEditAreaId($visibleItem['ID']); ?>">
                                                <a href="<?= $visibleItem['SECTION_PAGE_URL'] ?>">
                                                    <?= $visibleItem['NAME'] ?>
                                                </a>
                                            </li>
                                        <? endforeach; ?>
                                    <? endforeach; ?>
                                </ul>
                            <? endif; ?>
                        </div>
                        <? if (!empty($chunk)): ?>
                            <div class="catalog-block__btn">
                                <button class="btn btn-outline-secondary open-list js-open-list" data-text="<?=GetMessage('HIDDEN_SECTIONS')?>">
                                    <?=GetMessage('SHOW_MORE_SECTIONS')?>
                                </button>
                            </div>
                        <? endif; ?>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
        <? if (count($arResult['MAIN_SECTIONS']) > 4): ?>
            <div class="catalog-block__more">
                <button class="btn btn-outline-primary open-catalog-item js-open-catalog-item">
                    <?=GetMessage('MORE_SECTION')?>
                </button>
            </div>
        <? endif; ?>
    </div>
</div>