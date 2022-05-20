<?php
/**
 * Created by PhpStorm.
 * User: 2qucick
 * Date: 04.01.2018
 * Time: 10:05
 */

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;

class Services extends Controller
{

    /**
     * @return \array[][]
     */
    public function configureActions(): array
    {
        return [
            'getDetail' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param array $fields
     * @return string[]|null
     */
    public function getDetailAction(array $fields): ?array
    {
        return [
            'html' => $this->getDetailByID($fields['ID']),
        ];
    }

    /**
     * @param int $id
     * @return string
     */
    private function getDetailByID(int $id): string
    {
        ob_start();
        $GLOBALS['APPLICATION']->IncludeComponent(
            "bitrix:news.detail",
            "services",
            array(
                "ACTIVE_DATE_FORMAT" => "j F Y",
                "ADD_ELEMENT_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BROWSER_TITLE" => "-",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "services",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_CODE" => "",
                "ELEMENT_ID" => $id,
                "FIELD_CODE" => array(0 => "", 1 => "",),
                "IBLOCK_ID" => "10",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_URL" => "",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "MESSAGE_404" => "",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Страница",
                "PROPERTY_CODE" => array(
                    0 => "BLOCK_1_TITLE",
                    1 => "BLOCK_2_TITLE",
                    2 => "BLOCK_4_TITLE",
                    3 => "BLOCK_3_TITLE",
                    4 => "BLOCK_1_LIST",
                    5 => "BLOCK_2_LIST",
                    6 => "BLOCK_3_LIST",
                    7 => "BLOCK_4_TEXT",
                    8 => "ANOTHER_SERVICE",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_CANONICAL_URL" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "USE_PERMISSIONS" => "N",
                "USE_SHARE" => "N"
            )
        );
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}