<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
use Bitrix\Main\Grid\Declension;
$declension = new Declension('товар', 'товара', 'товаров');

?>
<div class="basket-menu__total">
    <div class="basket-menu__final">
        <?=$arResult['NUM_PRODUCTS']?> <?=$declension->get($arResult['NUM_PRODUCTS'])?>
    </div>
    <div class="basket-menu__final">
        <?=$arResult['TOTAL_PRICE']?>
    </div>
</div>
<a href="<?=$arParams['PATH_TO_BASKET']?>" class="basket-menu__more">
    Перейти в корзину
</a>