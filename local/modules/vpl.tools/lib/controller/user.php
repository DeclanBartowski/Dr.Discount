<?php
/**
 * Created by PhpStorm.
 * User: 2qucick
 * Date: 04.01.2018
 * Time: 10:05
 */

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;

class User extends Controller
{

    /**
     * @return \array[][]
     */
    public function configureActions(): array
    {
        return [
            'logout' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     *
     */
    public function logoutAction(): void
    {
        $GLOBALS['USER']->Logout();
    }


}