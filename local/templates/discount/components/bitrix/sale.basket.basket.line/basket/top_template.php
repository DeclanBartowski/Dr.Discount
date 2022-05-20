<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
?>
<button class="header__basket js-header__basket">
    <span class="header__basket-icon">
	    <? if ($arResult['NUM_PRODUCTS'] > 0) { ?>
	        <span class="header__basket-count">
				<?= $arResult['NUM_PRODUCTS']; ?>
			</span>
        <? } ?>
	    <svg class="icon icon-basket">
	        <use xlink:href="#icon-basket"></use>
	    </svg>
    </span>
	Корзина
</button>