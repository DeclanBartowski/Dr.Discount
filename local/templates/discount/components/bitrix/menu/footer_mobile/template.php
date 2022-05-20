<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="panel js-panel">
        <div class="container">
            <div class="panel__list">
                <?foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
        if($arItem['PARAMS']['IS_MENU'] == 'Y'){?>
            <div class="panel__item panel-open js-open-nav">
                <span>
            <svg class="icon icon-burger">
                <use xlink:href="#icon-burger"></use>
            </svg>
            <svg class="icon icon-close3 header__close">
                <use xlink:href="#icon-close3"></use>
            </svg>
                </span>
                <?=$arItem['TEXT']?>
            </div>
            <?}else{
            ?>
            <a href="<?=$arItem['LINK']?>" class="panel__item ">

                <span>
                    <?if($arItem['PARAMS']['ICON']){?>
                    <svg class="icon <?=$arItem['PARAMS']['ICON']?>">
                        <use xlink:href="#<?=$arItem['PARAMS']['ICON']?>"></use>
                    </svg>
                <?}?>
                </span>
                <?=$arItem['TEXT']?>
            </a>
            <?
        }
    ?>

    <?endforeach?>
            </div>
        </div>
    </div>
<?endif?>