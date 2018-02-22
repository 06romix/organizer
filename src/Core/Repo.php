<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/3/2017
 * Time: 06:15 AM
 */

namespace Core;

use Core\Model\Repository;

class Repo
{
    /**
     * @var Repository
     */
    protected static $repo;

    public function init()
    {
        if (!isset(static::$repo)) {
            self::$repo = new Repository();
        }
    }

    public static function getModel($name)
    {
        return self::$repo->getModel($name);
    }

    public static function getController($module, $controller, $path = null)
    {
        return self::$repo->getModel(
            ucfirst($path) . CD . $module . CD
            . 'Controller' . CD . $controller . 'Controller'
        );
    }

    public static function get($name)
    {
        return self::$repo->get($name);
    }
}
