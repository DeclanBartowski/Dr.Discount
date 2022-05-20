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

<div class="catalog__heading">
    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="filterDesktop">
        <input
                class="btn btn-themes"
                type="hidden"
                id="set_filter"
                name="set_filter"
                value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
        />
        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                   value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <? endforeach; ?>
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $key => $arItem)//prices
            {
                $key = $arItem["ENCODED_ID"];
                if (isset($arItem["PRICE"])):
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                        continue;
                    }

                    $step_num = 4;
                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
                    $prices = array();
                    if (Bitrix\Main\Loader::includeModule("currency")) {
                        for ($i = 0; $i < $step_num; $i++) {
                            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i,
                                $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                        }
                        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"],
                            $arItem["VALUES"]["MAX"]["CURRENCY"], false);
                    } else {
                        $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                        for ($i = 0; $i < $step_num; $i++) {
                            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $precision, ".",
                                "");
                        }
                        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                    }


                    ?>


                    <div class="catalog__filter js-catalog__filter">
                        <div class="catalog__front catalog__front-full js-catalog__front">
                            <div class="catalog-marks js-catalog-marks">
                                <?= $arItem["NAME"] ?>
                                <div class="catalog__numbers" id="price-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>">
                                    <?= (!empty($arItem['VALUES']['MIN']['HTML_VALUE'])) ? $arItem['VALUES']['MIN']['HTML_VALUE'] : $arItem['VALUES']['MIN']['VALUE'] ?>
                                    – <?= (!empty($arItem['VALUES']['MAX']['HTML_VALUE'])) ? $arItem['VALUES']['MAX']['HTML_VALUE'] : $arItem['VALUES']['MAX']['VALUE'] ?>
                                </div>
                            </div>
                            <?/*
                            <button class="catalog__close">
                                <svg class="icon icon-close">
                                    <use xlink:href="#icon-close"></use>
                                </svg>
                            </button>*/?>
                        </div>
                        <div class="catalog__filters js-catalog__filters">
                            <div class="catalog__inner js-catalog__inner">
                                <div class="catalog__title">
                                    <?= $arItem["NAME"] ?>
                                </div>
                                <div class="catalog__inputs">
                                    <div class="catalog__input">
                                        <input type="number" min="<?= $arItem['VALUES']['MIN']['VALUE'] ?>"
                                               max="<?= $arItem['VALUES']['MAX']['VALUE'] ?>"
                                               step="1"
                                               name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                               value="<?= (!empty($arItem['VALUES']['MIN']['HTML_VALUE'])) ? $arItem['VALUES']['MIN']['HTML_VALUE'] : $arItem['VALUES']['MIN']['VALUE'] ?>"
                                               id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                               class="form-control">
                                    </div>
                                    <div class="catalog__input">
                                        <input type="number" min="<?= $arItem['VALUES']['MIN']['VALUE'] ?>"
                                               max="<?= $arItem['VALUES']['MAX']['VALUE'] ?>"
                                               step="1"
                                               value="<?= (!empty($arItem['VALUES']['MAX']['HTML_VALUE'])) ? $arItem['VALUES']['MAX']['HTML_VALUE'] : $arItem['VALUES']['MAX']['VALUE'] ?>"
                                               name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                               id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div id="catalog-range-<?= $arItem['CODE'] ?>" class="catalog__slider"></div>


                                <script>

                                    let inputNum1 = document.getElementById('<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>');

                                    let html5Slider = document.getElementById('catalog-range-<?=$arItem['CODE']?>');

                                    noUiSlider.create(html5Slider, {
                                        start: [<?=(!empty($arItem['VALUES']['MIN']['HTML_VALUE'])) ? $arItem['VALUES']['MIN']['HTML_VALUE'] : $arItem['VALUES']['MIN']['VALUE'] ?>, <?=(!empty($arItem['VALUES']['MAX']['HTML_VALUE'])) ? $arItem['VALUES']['MAX']['HTML_VALUE'] : $arItem['VALUES']['MAX']['VALUE'] ?>],
                                        connect: true,
                                        behaviour: 'tap',
                                        range: {
                                            'min': <?=$arItem['VALUES']['MIN']['VALUE']?>,
                                            'max': <?=$arItem['VALUES']['MAX']['VALUE']?>
                                        },
                                        format: wNumb({
                                            decimals: 0,
                                            thousand: '',
                                        })
                                    });

                                    let inputNum2 = document.getElementById('<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>');

                                    html5Slider.noUiSlider.on('update', function (values, handle) {

                                        let value = values[handle];

                                        if (handle) {
                                            inputNum2.value = value;
                                        } else {
                                            inputNum1.value = Math.round(value);
                                        }

                                        $('#price-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>').html(values[0] + ' - ' + values[1]);

                                    });

                                    html5Slider.noUiSlider.on('change', function (values, handle) {

                                        updateCatalogFilter();

                                    });

                                    inputNum1.addEventListener('change', function () {
                                        html5Slider.noUiSlider.set([this.value, null]);
                                        updateCatalogFilter();
                                    });

                                    inputNum2.addEventListener('change', function () {
                                        html5Slider.noUiSlider.set([null, this.value]);
                                        updateCatalogFilter();
                                    });

                                </script>

                            </div>
                        </div>
                    </div>


                <?endif;
            }

            //not prices
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                if (
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                ) {
                    continue;
                }

                if (
                    $arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                ) {
                    continue;
                }
                ?>
                <div class="catalog__filter  catalog__filter-full js-catalog__filter">


                    <?
                    $arCur = current($arItem["VALUES"]);
                    switch ($arItem["DISPLAY_TYPE"]) {
                        case "A"://NUMBERS_WITH_SLIDER
                            break;
                        case "B"://NUMBERS
                            break;
                        case "G"://CHECKBOXES_WITH_PICTURES
                            break;
                        case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                            break;
                        case "P"://DROPDOWN
                            break;
                        case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS

                            break;
                        case "K"://RADIO_BUTTONS

                            break;
                        case "U"://CALENDAR

                            break;
                        default://CHECKBOXES

                            $checked = [];
                            foreach ($arItem["VALUES"] as $val => $ar) {

                                if ($ar["CHECKED"]) {
                                    $checked[] = $ar;
                                }

                            }
                            $count = count($checked);

                            ?>


                            <? if ($arItem['CODE'] == 'BRAND'):?>
                                <div class="catalog__front js-catalog__front <? if ($count > 0):?>catalog__front-full<?endif ?>">
                                    <div class="catalog-marks js-catalog-marks">
                                        <?= $arItem["NAME"] ?>

                                            <div class="catalog__numbers" <? if ($count < 1):?> style="display: none;" <?endif; ?>>
                                                <?= $count ?>
                                            </div>

                                    </div>

                                        <button class="catalog__close js-close-btn" type="button" <? if ($count < 1):?> style="display: none;" <?endif; ?>>
                                            <svg class="icon icon-close">
                                                <use xlink:href="#icon-close"></use>
                                            </svg>
                                        </button>

                                </div>
                                <div class="catalog__filters js-catalog__filters js-catalog__filter">
                                    <div class="catalog__inner js-catalog__inner">
                                        <div class="catalog__title"><?= $arItem["NAME"] ?></div>

                                        <div class="menus__scroll js-menus__scroll">

                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                <label  class="menus__brand">

                                                    <? if (!empty($arResult['BRANDS'][$val]['PREVIEW_PICTURE_SRC'])):?>
                                                        <span class="menus__brand-icon">
                                                            <img src="<?= $arResult['BRANDS'][$val]['PREVIEW_PICTURE_SRC'] ?>"
                                                                 alt="<?= $ar["VALUE"]; ?>"
                                                                 title="<?= $ar["VALUE"]; ?>">
                                                        </span>
                                                    <?endif; ?>
                                                    <input
                                                            style="display: none;"
                                                            class="js-change-filter"
                                                            type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
                                                    <span class="menus__brand-text"><?= $ar["VALUE"]; ?></span>
                                                </label>
                                            <?endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                        <? else:?>

                            <div class="catalog__front <? if ($count > 0):?>catalog__front-full<?endif ?> js-catalog__front">
                                <div class="catalog-marks js-catalog-marks">
                                    <?= $arItem["NAME"] ?>

                                        <div class="catalog__numbers" <? if ($count < 1):?> style="display: none;" <?endif; ?>>
                                            <?= $count ?>
                                        </div>

                                </div>

                                    <button class="catalog__close js-close-btn" type="button" <? if ($count < 1):?> style="display: none;" <?endif; ?>>
                                        <svg class="icon icon-close">
                                            <use xlink:href="#icon-close"></use>
                                        </svg>
                                    </button>

                            </div>
                            <div class="catalog__filters js-catalog__filters">
                                <div class="catalog__inner js-catalog__inner">
                                    <div class="catalog__title">
                                        <?= $arItem["NAME"] ?>
                                    </div>


                                    <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                        <div class="form-group">
                                            <label class="catalog__checkbox">
                                                <input
                                                        class="js-change-filter"
                                                        type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                                        name="<? echo $ar["CONTROL_NAME"] ?>"
                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
                                                <span class="catalog__check"></span>
                                                <?= $ar["VALUE"]; ?>
                                            </label>
                                        </div>
                                    <?endforeach; ?>
                                </div>
                            </div>

                        <?endif; ?>

                        <?
                    }
                    ?>
                </div>
                <?
            }
            ?>
        </div>

    </form>

</div>
