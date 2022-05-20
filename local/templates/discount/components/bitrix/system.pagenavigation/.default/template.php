<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$ClientID = 'navigation_' . $arResult['NavNum'];

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}
?>
<nav aria-label="navigation" class="navigation navigation-blue">
	<ul class="pagination">
        <?
        $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
        $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
        if ($arResult["bDescPageNumbering"] === true) {

        } else {
            $arResult["nStartPage"] = 1;
            $arResult["nEndPage"] = $arResult["NavPageCount"];

            $sPrevHref = '';
            if ($arResult["NavPageNomer"] > 1) {
                $bPrevDisabled = false;

                if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2) {
                    $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
                } else {
                    $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
                }
            } else {
                $bPrevDisabled = true;
            }

            $sNextHref = '';
            if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                $bNextDisabled = false;
                $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
            } else {
                $bNextDisabled = true;
            }
            if ($bPrevDisabled):?>
	            <li class="page-item">
		            <a class="page-link" aria-label="Previous"
		               alt="<?= GetMessage("nav_prev") ?>">
			            <svg class="icon icon-prev">
				            <use xlink:href="#icon-prev"></use>
			            </svg>
		            </a>
	            </li>
            <? else: ?>
				<li class="page-item">
					<a class="page-link" href="<?= $sPrevHref; ?>" aria-label="Previous"
					   alt="<?= GetMessage("nav_prev") ?>">
						<svg class="icon icon-prev">
							<use xlink:href="#icon-prev"></use>
						</svg>
					</a>
				</li>
            <? endif; ?>

            <?
            $bFirst = true;
            $bPoints = false;
            do {
                if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                        ?>
						<li class="page-item active">
							<a class="page-link"><?= $arResult["nStartPage"] ?></a>
						</li>
                    <?
					elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
                        ?>
						<li class="page-item">
							<a class="page-link"
							   href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
						</li>
                    <?
                    else:
                        ?>
						<li class="page-item">
							<a class="page-link"
							   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
						</li>
                    <?
                    endif;
                    $bFirst = false;
                    $bPoints = true;
                } else {
                    if ($bPoints) {
                        ?>
						<li class="page-item">
							<a class="page-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"]+5 ?>=<?= $arResult["nStartPage"] ?>">...</a>
						</li>
                        <?
                        $bPoints = false;
                    }
                }
                $arResult["nStartPage"]++;
            } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

            if ($bNextDisabled):?>
	            <li class="page-item">
		            <a class="page-link" aria-label="Next"
		               alt="<?= GetMessage("nav_next") ?>">
			            <svg class="icon icon-next">
				            <use xlink:href="#icon-next"></use>
			            </svg>
		            </a>
	            </li>
            <? else: ?>
				<li class="page-item">
					<a class="page-link" href="<?= $sNextHref; ?>" aria-label="Next"
					   alt="<?= GetMessage("nav_next") ?>">
						<svg class="icon icon-next">
							<use xlink:href="#icon-next"></use>
						</svg>
					</a>
				</li>
            <? endif; ?>
            <?
        }
        ?>
	</ul>
</nav>
