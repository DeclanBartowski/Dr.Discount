<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<div class="header__catalog">
	<button class="catalog-open js-catalog-open">
        <span class="burger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </span>
        <?= GetMessage('CATALOG') ?>
	</button>
	<div class="menus js-menus" id="js-menus">
		<div class="container">
			<div class="catalog-close js-catalog-close">
				<svg class="icon icon-close">
					<use xlink:href="#icon-close"></use>
				</svg>
			</div>
			<div class="tabs__wp">
				<div class="tabs__nav js-animate">
					<ul class="nav nav-pills">
                        <? foreach ($arResult['MAIN_SECTIONS'] as $key => $section) { ?>
							<li <? if ($key == 0) { ?>class="active"<? } ?>>
								<a href="#tab-<?= $section['ID']; ?>" data-toggle="tab"
								   class="nav-pills-link js-nav-pills-link">
                                <span>
                                    <svg class="icon <?= $section['UF_MENU_ICON'] ?>">
                                        <use xlink:href="#<?= $section['UF_MENU_ICON'] ?>"></use>
                                    </svg>
                                </span>
                                    <?= $section['NAME'] ?>
								</a>
							</li>
                        <? } ?>
					</ul>
				</div>
				<div class="tab-content well js-animate-slow">
                    <? foreach ($arResult['MAIN_SECTIONS'] as $key => $section) { ?>
						<div class="tab-pane <? if ($key == 0) { ?>active<? } ?>" id="tab-<?= $section['ID'] ?>">
							<ul class="nav">
                                <? foreach ($arResult['SUB_SECTIONS'][$section['ID']] as $subSection) { ?>
									<li class="nav-item">
										<a href="<?= $subSection['SECTION_PAGE_URL']; ?>" class="nav-link">
                                            <?= $subSection['NAME']; ?>
										</a>
									</li>
                                <? } ?>
							</ul>
						</div>
                    <? } ?>
				</div>
                <? if ($arResult['BRANDS']) { ?>
					<div class="menus__manufactures">
						<div class="menus__manufactures-title">
                            <?= GetMessage('BRANDS') ?>
						</div>
						<div class="menus__scroll js-menus__scroll">
                            <? foreach ($arResult['BRANDS'] as $brand) { ?>
								<a href="<?= $brand['DETAIL_PAGE_URL'] ?: 'javascript:void(0)' ?>"
								   class="menus__brand">
                                    <? if ($brand['PICTURE']) { ?>
										<span class="menus__brand-icon">
		                                    <img src="<?= $brand['PICTURE']; ?>" alt="">
		                                </span>
                                    <? } ?>
									<span class="menus__brand-text">
		                                <?= $brand['NAME']; ?>
	                                </span>
								</a>
                            <? } ?>
						</div>
					</div>
                <? } ?>
			</div>
		</div>
	</div>
</div>