<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/2/2017
 * Time: 12:05 AM
 */

namespace Api;

use Core\ConfigLoader;
use Core\Model\RouteConfig;
use Core\Repo;

class App
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var ConfigLoader
     */
    protected $configLoader;

    protected static $config;

    /**
     * @var RouteConfig
     */
    protected static $routeConfig;

    public function __construct()
    {
        $repo = new Repo();
        $repo->init();

        $this->configLoader = Repo::get(ConfigLoader::class);
        self::$config = $this->configLoader->getConfig();
        self::$routeConfig = $this->configLoader->getRouteConfig();
        $this->router = Repo::get(Router::class);
    }

    public function run()
    {
        $this->router->match();
    }

    public static function getConfig()
    {
        return self::$config;
    }

    public static function getRouteConfig()
    {
        return self::$routeConfig;
    }
}
