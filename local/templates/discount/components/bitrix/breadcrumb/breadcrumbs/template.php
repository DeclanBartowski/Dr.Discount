<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult)) {
    return "";
}

$strReturn = '';

$strReturn .= '<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">';

$itemSize = count($arResult);

for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
        if ($index == 0) {
            $strReturn .= '<li class="breadcrumb-item">
						<a href="' . $arResult[$index]["LINK"] . '"><img src="' . SITE_TEMPLATE_PATH . '/img/icons/home.png" alt="home_page" title="home_page"></a>
					</li>';
        } else {
            $strReturn .= '<li class="breadcrumb-item active" aria-current="page"><a href="' . $arResult[$index]["LINK"] . '">' . $title . '</a></li>';
        }

    } else {
        $strReturn .= '';
    }
}

$strReturn .= '</ol>
			</nav>
		</div>';

return $strReturn;