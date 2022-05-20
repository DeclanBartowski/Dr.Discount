<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */




if (empty($arResult['ERROR_MESSAGE'])) {
    ?>
    <div class="basket">
        <div class="basket__btn">
            <a href="javascript:void(0)" class="basket__clear js-basket__clear">
                <?=GetMessage('CLEAR_BASKET')?>
            </a>
        </div>
        <div class="basket-table">
            <table>
                <thead>
                    <tr>
                        <th><?=GetMessage('GRID_TITLE_NAME')?></th>
                        <th><?=GetMessage('GRID_TITLE_QUANTITY')?></th>
                        <th><?=GetMessage('GRID_TITLE_PRICE')?></th>
                        <th><?=GetMessage('GRID_TITLE_SUM')?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <? foreach ($arResult['GRID']['ROWS'] as $row): ?>
                    <tr>
                        <td>
                            <a href="<?= $row['DETAIL_PAGE_URL'] ?>" class="basket-table__info">
                                <span class="basket-table__icon">
                                   <img src="<?= (empty($row['PREVIEW_PICTURE_SRC'])) ? CATALOG_NO_PHOTO : $row['PREVIEW_PICTURE_SRC'] ?>" alt="<?= $row['NAME'] ?>" title="<?= $row['NAME'] ?>" loading="lazy">
                                </span>
                                <span class="basket-table__text"><span>
                                      <? if ($row['LABELS']['VALUE']) { ?>
                                          <div class="tags">
                                              <? foreach ($row['LABELS']['VALUE'] as $key => $label) {
                                                  $icons = explode('/', $row['LABELS']['VALUE_XML_ID'][$key]);
                                                  ?>
                                                  <div class="tag <?= $icons[0]; ?>">
                                                      <span><svg class="icon <?= $icons[1]; ?>"><use xlink:href="#<?= $icons[1]; ?>"></use></svg></span>
                                                      <?= $label; ?>
                                                  </div>
                                              <? } ?>
                                          </div>
                                      <? } ?>
                                </span>
                                    <?= $row['NAME'] ?>
                                    <? if (!empty($row['PROPERTY_ARTNUMBER_VALUE'])): ?>
                                        <span class="basket-table__article"><?=GetMessage('ARTNUMBER_TITLE')?> <?= $row['PROPERTY_ARTNUMBER_VALUE'] ?></span>
                                    <? endif; ?>
                            </span>
                            </a>
                        </td>
                        <td>
                            <div class="card__touchspin">
                                <input type="text" class="input-touchspin js-input-touchspin js-quantity-update" data-id="<?=$row['ID']?>" value="<?= $row['QUANTITY'] ?>">
                            </div>
                        </td>
                        <td data-text="<?=GetMessage('PRICE_TITLE')?>">
                            <?= $row['PRICE_FORMATED'] ?>
                            <? if (!empty($row["DISCOUNT_PRICE"])): ?>
                                <span class="text-discount"><?= $row['FULL_PRICE_FORMATED'] ?></span>
                            <? endif; ?>
                        </td>
                        <td data-text="<?=GetMessage('SUM_TITLE')?>">
                            <b>
                                <?= $row['SUM'] ?>
                            </b>
                        </td>
                        <td>
                            <button class="product-delete js-product-delete" data-id="<?=$row['ID']?>">
                                <svg class="icon icon-close">
                                    <use xlink:href="#icon-close"></use>
                                </svg>
                            </button>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="basket__wp">
            <div class="form-group">
                <label>
                    <?=GetMessage('PROMOCODE_ENTER_TITLE')?>
                </label>
                <input type="text" class="form-control js-promocode" autocomplete="off">
                <br>
                <?foreach ($arResult['COUPON_LIST'] as $item):?>
                    <p class="coupon_<?=$item['JS_STATUS']?>"><?=GetMessage('COUPON_TITLE')?> <?=$item['COUPON']?> <?=$item['STATUS_TEXT']?></p>
                <?endforeach;?>
            </div>
            <div class="basket__total">
                <p>
                    <?=GetMessage('SUM_BASKET_TITLE')?>
                </p>
                <div class="card__prices">
                    <div class="card__price">
                        <?= $arResult['allSum_FORMATED'] ?>
                    </div>
                    <? if (!empty($arResult['DISCOUNT_PRICE_ALL'])): ?>
                        <div class="card__discount">
                            <?= $arResult['DISCOUNT_PRICE_ALL_FORMATED'] ?>
                        </div>
                    <? endif ?>
                </div>
            </div>
            <button class="btn btn-primary" onclick="location.href='/order/'">
                <?=GetMessage('ORDER_BTN')?>
            </button>
        </div>
    </div>
    <?php
} elseif ($arResult['EMPTY_BASKET']) {
    include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
} else {
    ShowError($arResult['ERROR_MESSAGE']);
}