<?php
/**
 * Created by PhpStorm.
 * User: 2qucick
 * Date: 04.01.2018
 * Time: 10:05
 */

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Loader;

class Basket extends Controller
{

    public function configureActions(): array
    {
        return [
            'changeQuantity' => [
                'prefilters' => [],
            ],
            'remove' => [
                'prefilters' => [],
            ],
            'clearAll' => [
                'prefilters' => [],
            ],
            'add2Basket' => [
                'prefilters' => [],
            ],
            'setCoupon' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param int $id
     * @param int $quantity
     * @return int[]
     */
    public function add2BasketAction(int $id, int $quantity): array
    {

        Loader::includeModule('sale');
        Loader::includeModule('catalog');
        Add2BasketByProductID($id, $quantity);
        return [
            'id' => $id,
            'quantity' => $quantity
        ];
    }

    /**
     * @return string[]
     */
    public function clearAllAction(): array
    {
        Loader::includeModule('sale');
        \CSaleBasket::DeleteAll(\CSaleBasket::GetBasketUserID());
        return [
            'html' => $this->getBasketHTML(),
        ];
    }


    /**
     * @param array $fields
     * @return string[]
     */
    public function removeAction(array $fields): array
    {
        Loader::includeModule('sale');
        \CSaleBasket::Delete($fields['ID']);
        return [
            'html' => $this->getBasketHTML(),
        ];
    }

    /**
     * @param array $fields
     * @return string[]
     */
    public function changeQuantityAction(array $fields): array
    {
        Loader::includeModule('sale');
        \CSaleBasket::Update($fields['ID'], [
            'QUANTITY' => $fields['VALUE']
        ]);
        return [
            'html' => $this->getBasketHTML(),
        ];
    }

    /**
     * @return string
     */
    private function getBasketHTML(): string
    {
        ob_start();
        $GLOBALS['APPLICATION']->IncludeComponent(
            "bitrix:sale.basket.basket",
            "",
            Array(
                "ACTION_VARIABLE" => "basketAction",
                "ADDITIONAL_PICT_PROP_1" => "-",
                "AUTO_CALCULATION" => "Y",
                "BASKET_IMAGES_SCALING" => "adaptive",
                "COLUMNS_LIST_EXT" => array("PREVIEW_PICTURE","DETAIL_PICTURE","PROPERTY_LABELS","PROPERTY_ARTNUMBER"),
                "COLUMNS_LIST_MOBILE" => array("PREVIEW_PICTURE"),
                "COMPATIBLE_MODE" => "Y",
                "CORRECT_RATIO" => "Y",
                "DEFERRED_REFRESH" => "N",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_MODE" => "extended",
                "EMPTY_BASKET_HINT_PATH" => "/",
                "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                "GIFTS_CONVERT_CURRENCY" => "N",
                "GIFTS_HIDE_BLOCK_TITLE" => "N",
                "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                "GIFTS_MESS_BTN_BUY" => "Выбрать",
                "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                "GIFTS_PLACE" => "BOTTOM",
                "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                "GIFTS_SHOW_OLD_PRICE" => "N",
                "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                "HIDE_COUPON" => "N",
                "LABEL_PROP" => array(),
                "PATH_TO_ORDER" => "/personal/order/make/",
                "PRICE_DISPLAY_MODE" => "Y",
                "PRICE_VAT_SHOW_VALUE" => "N",
                "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
                "QUANTITY_FLOAT" => "Y",
                "SET_TITLE" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_FILTER" => "N",
                "SHOW_RESTORE" => "Y",
                "TEMPLATE_THEME" => "blue",
                "TOTAL_BLOCK_DISPLAY" => array("top"),
                "USE_DYNAMIC_SCROLL" => "N",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_GIFTS" => "N",
                "USE_PREPAYMENT" => "N",
                "USE_PRICE_ANIMATION" => "N"
            )
        );
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @param string $coupon
     * @return string[]
     */
    public function setCouponAction(string $coupon): array
    {
        Loader::includeModule('catalog');
        Loader::includeModule('sale');
        \Bitrix\Sale\DiscountCouponsManager::clear(true);
        \CCatalogDiscountCoupon::SetCoupon($coupon);
        return [
            'html' => $this->getBasketHTML(),
        ];
    }
}