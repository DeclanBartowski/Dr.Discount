<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$isCatalog = false;?>

<?
if (!empty($arResult)): ?>
    <div class="menu">
    <ul class="menu-list">

    <?
    $previousLevel = 0;
foreach ($arResult

    as $arItem): ?>

    <?
    if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?
        if ($isCatalog) { ?>
            </ul>
            </div>
            </div>
            </div>
            <?if($arItem["DEPTH_LEVEL"] == 1){?>
                </div>
                </li>
            <?}?>
            <?
        } elseif ($isBrand) {
            ?>
            <?= str_repeat("</div>
							</div>
						</div>
            </li>", $previousLevel - $arItem["DEPTH_LEVEL"]); ?>
            <?
        } else { ?>
            <?= str_repeat("</ul>
                    </div>
                </div>
            </li>", $previousLevel - $arItem["DEPTH_LEVEL"]); ?>
            <?
        } ?>
    <?
    endif ?>


    <?
    if ($arItem["IS_PARENT"]){?>

    <?
    if ($arItem["DEPTH_LEVEL"] == 1){ ?>
    <?
    if ($arItem["PARAMS"]['IS_CATALOG'] == 'Y'){
        $isCatalog = true ?>
        <li class="menu-item">
            <div class="menu-heading">
                <a href="<?= $arItem["LINK"] ?>">
                    <?= $arItem["TEXT"] ?>
                </a>
                <span class="open-submenu  js-open-submenu">
			                    <svg class="icon icon-top2">
			                        <use xlink:href="#icon-top2"></use>
			                    </svg>
                            </span>
            </div>
            <div class="submenu js-submenu" id="submenu-1">

        <?
    }else{
    $isCatalog = false ?>
    <li class="menu-item">
    <div class="menu-heading">
        <a href="<?= $arItem["LINK"] ?>">
            <?= $arItem["TEXT"] ?>
        </a>
        <span class="open-submenu  js-open-submenu">
                    <svg class="icon icon-top2">
                        <use xlink:href="#icon-top2"></use>
                    </svg>
                    </span>
    </div>
    <?
    if ($arItem["PARAMS"]['IS_BRAND'] == 'Y'){
    $isBrand = true; ?>
    <div class="submenu js-submenu">
    <div class="submenu__list">
    <div class="menus__scroll js-menus__scroll">
    <?
    }else{
    $isBrand = true; ?>
    <div class="submenu js-submenu">
    <div class="submenu__list">
    <ul>
    <?
    } ?>

    <?
    } ?>

    <?
    }else{ ?>
    <?if($isCatalog){?>
            <div class="submenu__item">
                <div class="submenu__header" id="subHead-<?=$arItem['PARAMS']['ID']?>">
                    <button class="btn"
                            type="button" data-toggle="collapse"
                            data-target="#sub-<?=$arItem['PARAMS']['ID']?>"
                            aria-controls="sub-<?=$arItem['PARAMS']['ID']?>">
                        <?if($arItem['PARAMS']['UF_MENU_ICON']){?>
                                    <span>
                                    <svg class="icon <?=$arItem['PARAMS']['UF_MENU_ICON']?>">
                                    <use xlink:href="#<?=$arItem['PARAMS']['UF_MENU_ICON']?>"></use>
                                    </svg>
                                    </span>
                <?}?>
                        <?=$arItem['TEXT']?>
                    </button>
                </div>

                <div id="sub-<?=$arItem['PARAMS']['ID']?>" class="collapse"
                     aria-labelledby="subHead-<?=$arItem['PARAMS']['ID']?>"
                     data-parent="#submenu-1">
                    <div class="submenu__body">
                        <ul>
    <?}?>
    <?} ?>

    <?}else{ ?>

        <?
        if ($arItem["PERMISSION"] > "D"): ?>
        <?if($arItem['DEPTH_LEVEL'] == 1){
                $isCatalog = false;
            }?>
            <? if ($isCatalog) { ?>

                <li>
                    <a href=" <?=$arItem['LINK']?>">
                        <?=$arItem['TEXT']?>
                    </a>
                </li>
            <?
            } else { ?>
                <?
                if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <li class="menu-item">
                        <div class="menu-heading">
                            <a href="<?= $arItem["LINK"] ?>">
                                <?= $arItem["TEXT"] ?>
                            </a>
                        </div>
                    </li>
                <?
                else: ?>
                    <?
                    if (isset($arItem['PARAMS']['BRAND_ICON'])) { ?>
                        <a href="<?= $arItem["LINK"] ?>" class="menus__brand">
                                <span class="menus__brand-icon">
                                    <?
                                    if ($arItem['PARAMS']['BRAND_ICON']) { ?>
                                        <img src="<?= $arItem['PARAMS']['BRAND_ICON'] ?>" alt="<?= $arItem["TEXT"] ?>"
                                             title="<?= $arItem["TEXT"] ?>">
                                        <?
                                    } ?>
                                </span>
                            <span class="menus__brand-text">
                                    <?= $arItem["TEXT"] ?>
                                </span>
                        </a>
                        <?
                    } else { ?>
                        <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                        <?
                    } ?>
                <?
                endif ?>
            <?
            } ?>


        <?
        endif ?>

    <?} ?>

    <?
    $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

<?
endforeach ?>

    <?
    if ($previousLevel > 1)://close last item tags
        ?>
        <?
        if ($isCatalog) { ?>
            <?
        } else { ?>
            <?= str_repeat("</ul>
                    </div>
                </div>
            </li>", ($previousLevel - 1)); ?>
            <?
        } ?>

    <?
    endif ?>
    </ul>
    </div>
<?
endif ?>