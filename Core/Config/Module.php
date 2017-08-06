<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 11:45 PM
 */

namespace Core\Config;

use Core\Model\AbstractModel;

abstract class Module extends AbstractModel
{
    const CONTROLLERS_PATH = 'controllers';

    abstract public function getConfig();

    public function getControllers()
    {
        $config = $this->getConfig();
        if (isset($config[self::CONTROLLERS_PATH])) {
            return $config[self::CONTROLLERS_PATH];
        }
        return [];
    }
}