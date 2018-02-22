<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/3/2017
 * Time: 07:32 AM
 */

namespace Core;

use Api\Config;
use Api\Router;
use Core\Config\Module;
use Core\Model\AbstractModel;
use Core\Model\RouteConfig;

class ConfigLoader extends AbstractModel
{
    const CONFIG_PATH = 'Config' . CD . 'Module';
    const MODULE_PATH = 'module';
    const FLAG_LOADED = 'loaded';

    /**
     * @var array[]
     */
    protected $config = [
        'routes' => [],
    ];

    /**
     * @return array
     */
    public function getConfig()
    {
        if (!$this->hasFlag(self::FLAG_LOADED)) {
            /** @var $base Config */
            $base = Repo::get(Config::class);
            $baseConfig = $base->getConfig();
            foreach ($baseConfig as $route => $moduleName) {
                $this->config['routes'][$route] = [
                    'module' => $moduleName,
                    'controllers' => $this->getModuleConfig($moduleName)
                ];
            }
            $this->setFlag(self::FLAG_LOADED);
        }

        return $this->config;
    }

    /**
     * @param string $module
     * @return array
     */
    protected function getModuleConfig($module)
    {
        /** @var $moduleConfig Module */
        $moduleConfig = Repo::get(Router::PATH . CD . $module . CD . self::CONFIG_PATH);
        return $moduleConfig->getControllers();
    }

    public function getRouteConfig()
    {
        return Repo::getModel(RouteConfig::class);
    }
}
