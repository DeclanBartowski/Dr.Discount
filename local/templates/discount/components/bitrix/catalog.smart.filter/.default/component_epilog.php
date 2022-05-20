<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $templateData */
/** @var @global CMain $APPLICATION */

CJSCore::Init(array('fx', 'popup'));

if(get_class($this->__template)!=="CBitrixComponentTemplate")
    $this->InitComponentTemplate();


$this->__template->SetViewTarget("form_filter");
?>

<form action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="container">

    <div class="filters__heading">
        <button class="filters__clear" type="button" onclick="location.href='<? echo $arResult["FORM_ACTION"] ?>'">
            Очистить
        </button>
        <div class="filters__title">
               <span>
                 <svg class="icon icon-filters">
                   <use xlink:href="#icon-filters"></use>
                 </svg>
               </span>
            Фильтр
        </div>
        <div class="filters__close js-filters__close">
            <svg class="icon icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </div>
    </div>

    <div class="filters__main">
        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                   value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <? endforeach; ?>

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

                <div class="filters__item js-filters__item">
                    <button class="filters__open js-filters__open" type="button">
                        Цена (₽)
                    </button>
                    <div class="filters__body js-filters__body">
                        <div class="catalog__inputs">
                            <div class="catalog__input">

                                <input type="number" min="<?= $arItem['VALUES']['MIN']['VALUE'] ?>"
                                       max="<?= $arItem['VALUES']['MAX']['VALUE'] ?>"
                                       step="1"
                                       name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                       value="<?= (!empty($arItem['VALUES']['MIN']['HTML_VALUE'])) ? $arItem['VALUES']['MIN']['HTML_VALUE'] : $arItem['VALUES']['MIN']['VALUE'] ?>"
                                       id="mobile-<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                       class="form-control">


                            </div>
                            <div class="catalog__input">
                                <input type="number" min="<?= $arItem['VALUES']['MIN']['VALUE'] ?>"
                                       max="<?= $arItem['VALUES']['MAX']['VALUE'] ?>"
                                       step="1"
                                       value="<?= (!empty($arItem['VALUES']['MAX']['HTML_VALUE'])) ? $arItem['VALUES']['MAX']['HTML_VALUE'] : $arItem['VALUES']['MAX']['VALUE'] ?>"
                                       name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                       id="mobile-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div id="catalog-range-mobile-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>" class="catalog__slider"></div>
                    </div>
                </div>


                <script>
                    let inputNum11 = document.getElementById('mobile-<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>');

                    let html5Slider2 = document.getElementById('catalog-range-mobile-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>');

                    noUiSlider.create(html5Slider2, {
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

                    let inputNum22 = document.getElementById('mobile-<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>');

                    html5Slider2.noUiSlider.on('update', function (values, handle) {

                        let value = values[handle];

                        if (handle) {
                            inputNum22.value = value;
                        } else {
                            inputNum11.value = Math.round(value);
                        }
                    });

                    inputNum11.addEventListener('change', function () {
                        html5Slider2.noUiSlider.set([this.value, null]);
                    });

                    inputNum22.addEventListener('change', function () {
                        html5Slider2.noUiSlider.set([null, this.value]);
                    });
                </script>



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
            <div class="filters__item js-filters__item">
                <button class="filters__open js-filters__open" type="button">
                    <?= $arItem['NAME'] ?>
                </button>


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


                        <? if ($arItem['CODE'] == 'BRAND'): ?>
                        <div class="filters__body js-filters__body">
                            <div class="menus__scroll js-menus__scroll">
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                    <label class="menus__brand">
                                        <? if (!empty($arResult['BRANDS'][$val]['PREVIEW_PICTURE_SRC'])): ?>
                                            <span class="menus__brand-icon">
                                                            <img src="<?= $arResult['BRANDS'][$val]['PREVIEW_PICTURE_SRC'] ?>"
                                                                 alt="<?= $ar["VALUE"]; ?>"
                                                                 title="<?= $ar["VALUE"]; ?>">
                                                        </span>
                                        <? endif; ?>
                                        <input
                                                style="display: none;"
                                                class="js-change-filter"
                                                type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
                                        <span class="menus__brand-text"><?= $ar["VALUE"]; ?></span>
                                    </label>
                                <? endforeach; ?>
                            </div>
                        </div>
                    <? else: ?>
                        <div class="filters__body js-filters__body">
                            <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                <div class="form-group">
                                    <label class="catalog__checkbox">
                                        <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                               name="<? echo $ar["CONTROL_NAME"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>>
                                        <span class="catalog__check"></span>
                                        <?= $ar["VALUE"]; ?>
                                    </label>
                                </div>
                            <? endforeach; ?>
                        </div>
                    <? endif; ?>

                    <?
                }
                ?>
            </div>
            <?
        }
        ?>

    </div>
    <button type="submit" class="filters__btn" name="set_filter"
            value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>">
        Применить
    </button>
</form>

<?
    $this->__template->EndViewTarget();
?>