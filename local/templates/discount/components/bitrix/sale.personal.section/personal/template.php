<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;


if ($arParams["MAIN_CHAIN_NAME"] <> '') {
    $APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$availablePages = array();


$availablePages[] = [
    'LINK' =>  $arParams["SEF_URL_TEMPLATES"]['private'],
    'TITLE' => Loc::getMessage('SPS_PERSONAL_PAGE_NAME'),
    'SVG' => 'icon-acount'
];

$availablePages[] = [
    'LINK' => $arParams["PATH_TO_BASKET"],
    'TITLE' => Loc::getMessage('SPS_BASKET_PAGE_NAME'),
    'SVG' => 'icon-basket'
];

$availablePages[] = [
    'LINK' =>  $arParams["SEF_URL_TEMPLATES"]['orders'],
    'TITLE' =>  Loc::getMessage('SPS_ORDER_PAGE_HISTORY'),
    'SVG' => 'icon-history'
];

$availablePages[] = [
    'LINK' => $arParams["PATH_TO_FAVORITE"],
    'TITLE' => Loc::getMessage('SPS_FAVORITE_TITLE'),
    'SVG' => 'icon-favorite'
];

$availablePages[] = [
    'LINK' => $arParams["PATH_TO_RECOMMEND"],
    'TITLE' => Loc::getMessage('SPS_RECOMMEND_TITLE'),
    'SVG' => 'icon-recommendations'
];


?>

<div class="account">
    <div class="account__content">
        <?
        require_once __DIR__ . '/sidebar.php';
        ?>

        <div class="account__main">
            <div class="row">
                <? foreach ($availablePages as $page): ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?= $page['LINK'] ?>" class="account-link">
                            <span class="account-wrap">
                            <span class="account-icon">
                            <svg class="icon <?= $page['SVG'] ?>">
                                <use xlink:href="#<?= $page['SVG'] ?>"></use>
                            </svg>
                        </span>
                            <span class="account-text">
                            <?= $page['TITLE'] ?>
                        </span>
                            </span>
                        </a>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?
?>
