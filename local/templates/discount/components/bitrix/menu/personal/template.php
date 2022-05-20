<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? if (!empty($arResult)) { ?>
	<div class="aside">
		<ul>
            <? foreach ($arResult as $arItem) {
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                    continue;
                } ?>
				<li>
					<a href="<?= $arItem['LINK'] ?>"<? if ($arItem['SELECTED']) {
                        ?> class="active"<? } ?>>
                        <?= $arItem['TEXT'] ?>
                        <? if (!empty($arItem['PARAMS']['COUNTER'])) { ?>
							<span><? eval($arItem['PARAMS']['COUNTER']); ?></span>
                        <? } ?>
					</a>
				</li>
            <? } ?>
		</ul>
	</div>
<? } ?>
