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

$format = [
    'application/pdf' => 'icon-pdf'
];

?>
<div class="catalogs">
    <div class="accordion" id="catalogsAccordion">
        <? foreach ($arResult['SECTIONS_MAIN'] as $key => $arSection): ?>
            <div class="accordion-item">
                <div class="accordion-header" id="catalog-<?= $arSection['ID'] ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button"
                                data-toggle="collapse" data-target="#collapse-<?= $arSection['ID'] ?>"
                                aria-expanded="true" aria-controls="collapse-<?= $arSection['ID'] ?>">
                            <?= $arSection['NAME'] ?>
                            <span>
                            <svg class="icon icon-top">
                                <use xlink:href="#icon-top"></use>
                            </svg>
                        </span>
                        </button>
                    </h2>
                </div>
                <div id="collapse-<?= $arSection['ID'] ?>" class="collapse <?if($key == 0):?>show <?endif;?>"
                     aria-labelledby="catalog-<?= $arSection['ID'] ?>" data-parent="#catalogsAccordion">
                    <div class="accordion-body">
                        <? foreach ($arResult['SECTIONS_SUB'][$arSection['ID']] as $brand): ?>
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        <div class="catalogs__head">
                                            <? if (!empty($brand['PICTURE_SRC'])): ?>
                                                <div class="catalogs__icon">
                                                    <img src="<?= $brand['PICTURE_SRC'] ?>" alt="<?= $brand['NAME'] ?>"
                                                         title="<?= $brand['NAME'] ?>" loading="lazy">
                                                </div>
                                            <? endif; ?>
                                            <div class="catalogs__text">
                                                <div class="catalogs__name">
                                                    <?= $brand['NAME'] ?>
                                                </div>
                                                <button type="button" 
                                                        data-text="<?=$brand['DESCRIPTION']?>"
                                                        data-picture="<?=$brand['PICTURE_SRC']?>"
                                                        data-title="<?=$brand['NAME']?>"
                                                        class="catalogs__occupation js_modal_brand">
                                                    Описание бренда
                                                    <span><svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                               xmlns="http://www.w3.org/2000/svg">
<path d="M5.01042 1.375H2C1.44772 1.375 1 1.82272 1 2.375V10C1 10.5523 1.44772 11 2 11H9.625C10.1773 11 10.625 10.5523 10.625 10V6.98958"
      stroke="#4F6688" stroke-width="1.5"/>
<mask id="path-2-inside-1_1806_21237" fill="white">
<rect x="6.5" width="5.5" height="5.5" rx="1"/>
</mask>
<rect x="6.5" width="5.5" height="5.5" rx="1" stroke="#4F6688" stroke-width="3"
      mask="url(#path-2-inside-1_1806_21237)"/>
</svg></span>
                                                </button>
                                            </div>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <? foreach ($arResult['SECTIONS_ITEMS'][$brand['ID']] as $arItem): ?>
                                    <?
                                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                                    ?>
                                    <tr id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                        <td>
                                            <a href="<?= $arItem['FILE']['SRC'] ?>" download="">
                                                <?= $arItem['NAME'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= $arItem['FILE']['SRC'] ?>" download="">
                                                <svg class="icon <?= $format[$arItem['FILE']['CONTENT_TYPE']] ?>">
                                                    <use xlink:href="#<?= $format[$arItem['FILE']['CONTENT_TYPE']] ?>"></use>
                                                </svg>
                                                <?= $arItem['FILE']['SIZE'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= $arItem['FILE']['SRC'] ?>" download="">
                                                <svg class="icon icon-external">
                                                    <use xlink:href="#icon-external"></use>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                                </tbody>
                            </table>
                        <? endforeach; ?>

                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>