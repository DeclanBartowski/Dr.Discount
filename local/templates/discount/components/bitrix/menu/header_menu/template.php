<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="header-nav">
    <?
    foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
            continue;
    ?>
        <li class="nav-item">
            <a href="<?=$arItem['LINK']?>" class="nav-link">
                <?if(!empty($arItem['PARAMS']['svg'])):?>
                    <span>
                       <svg class="icon <?=$arItem['PARAMS']['svg']?>">
                            <use xlink:href="#<?=$arItem['PARAMS']['svg']?>"></use>
                        </svg>
                    </span>
                <?endif;?>
                <?=$arItem['TEXT']?>
            </a>
        </li>
    <?endforeach?>
</ul>
<?endif?>