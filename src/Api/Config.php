<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 11:32 PM
 */

namespace Api;

class Config
{
    public function getConfig()
    {
        return [
            'core' => 'Core',
            'user' => 'User',
        ];
    }
}