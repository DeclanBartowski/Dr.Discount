<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
    <li>
        <a href="<?=$arItem['LINK']?>"
           data-text="<?=$arItem['TEXT']?>"
           <?if(!empty($arItem['PARAMS']['type'])):?>class="js-<?=$arItem['PARAMS']['type']?>"<?endif?>
           data-type="<?=$arItem['PARAMS']['type']?>">
            <?=$arItem['TEXT']?>
            <?if($arItem['PARAMS']['type'] == 'favorite'):?>
                <span <?if($arParams['FAVORITE'] < 1):?>style="display: none;"<?endif;?> class="js-count-favorite"><?if($arParams['FAVORITE'] > 0):?><?=$arParams['FAVORITE']?><?endif;?></span>
            <?endif;?>
        </a>
    </li>
	
<?endforeach?>
</ul>
<?endif?>