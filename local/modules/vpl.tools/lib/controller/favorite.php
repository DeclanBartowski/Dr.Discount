<?php
/**
 * Created by PhpStorm.
 * User: 2qucick
 * Date: 04.01.2018
 * Time: 10:05
 */

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;

class Favorite extends Controller
{

    /**
     * @return \array[][]
     */
    public function configureActions(): array
    {
        return [
            'favorite' => [
                'prefilters' => [],
            ],
        ];
    }


    /**
     * @param int $id
     * @return array
     */
    public function deleteAction(int $id): array
    {
        unset($_SESSION['FAVORITE'][$id]);
        return [
            'count' => count($_SESSION['FAVORITE']),
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function favoriteAction(int $id): array
    {
        $status = true;
        if (in_array($id, $_SESSION['FAVORITE'])) {
            unset($_SESSION['FAVORITE'][$id]);
            $status = false;
        } else {
            $_SESSION['FAVORITE'][$id] = $id;
        }
        return [
            'count' => count($_SESSION['FAVORITE']),
            'status' => $status,
        ];
    }

}