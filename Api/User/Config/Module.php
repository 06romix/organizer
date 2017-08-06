<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 09:44 AM
 */

namespace Api\User\Config;

class Module extends \Core\Config\Module
{
    public function getConfig()
    {
        return [
            'controllers' => [
                'auth' => [
                    'name' => 'Auth',
                    'actions' => [
                        'default' => 'index',
                        'list' => [
                            'login'
                        ]
                    ],
                ],
            ]
        ];
    }
}
