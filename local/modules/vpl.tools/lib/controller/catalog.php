<?php
/**
 * Created by PhpStorm.
 * User: 2qucick
 * Date: 04.01.2018
 * Time: 10:05
 */

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;

class Catalog extends Controller
{

    /**
     * @return \array[][]
     */
    public function configureActions(): array
    {
        return [
            'setViewCatalog' => [
                'prefilters' => [],
            ],
            'setSortCatalog' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param string $view
     */
    public function setViewCatalogAction(string $view): void
    {
        $_SESSION['VIEW_CATALOG'] = $view;
    }

    /**
     * @param string $sort
     */
    public function setSortCatalogAction(string $sort): void
    {
        $_SESSION['SORT_CATALOG'] = $sort;
    }

}