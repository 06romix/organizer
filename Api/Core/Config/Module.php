<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/3/2017
 * Time: 08:35 AM
 */

namespace Api\Core\Config;


class Module extends \Core\Config\Module
{
    public function getConfig()
    {
        return [
            'controllers' => [
//                'index',
            ]
        ];
    }
}
