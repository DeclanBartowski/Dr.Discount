<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];



if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>
    <div class="basket-menu__inner" data-role="basket-item-list">
        <div class="basket-menu__scroll js-basket-menu__scroll" id="<?=$cartId?>products">
            <?foreach ($arResult["CATEGORIES"] as $category => $items):
                if (empty($items))
                    continue;
                ?>
                <?foreach ($items as $v):?>
                <a href="<?=$v["DETAIL_PAGE_URL"]?>" class="basket-menu__item">
            <span class="basket-menu__icon">
                <img src="<?=$v["PICTURE_SRC"]?:sprintf('%s/img/NoPhoto.png',SITE_TEMPLATE_PATH)?>" alt="<?=$v["NAME"]?>" title="<?=$v["NAME"]?>">
            </span>
                    <span class="basket-menu__text">
                <span class="basket-menu__note">
                    <?=$v["NAME"]?>
                </span>
                <span class="basket-menu__prices">
                     <div class="bx-basket-item-list-item-price"><strong></strong></div>


                    <span class="basket-menu__price">
                        <?=$v["PRICE_FMT"]?>
                    </span>
                     <?if ($v["FULL_PRICE"] != $v["PRICE_FMT"]){?>
                    <span class="basket-menu__discount">
                       <?=$v["FULL_PRICE"]?>
                    </span>
                    <?}?>
                </span>
            </span>
                </a>


            <?endforeach?>
            <?endforeach?>
        </div>
    </div>


	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}
require(realpath(dirname(__FILE__)).'/top_template.php');