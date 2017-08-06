<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/6/2017
 * Time: 08:55 AM
 */

namespace Core\Model;

use Core\ConfigLoader;
use Core\Config\Module;
use Core\Controller\AbstractController;
use Core\Repo;

class RouteConfig extends AbstractModel
{
    const ACTION_SUFFIX = 'Action';

    /**
     * @var ConfigLoader
     */
    protected $configLoader;

    /**
     * [module, controller, action]
     *
     * @var array
     */
    protected $routePath;

    /**
     * @var null | AbstractController
     */
    protected $controller;

    /**
     * @var array
     */
    protected $controllerConfig;

    /**
     * @var null | string
     */
    protected $actionName;

    /**
     * [module, controller, action]
     *
     * @param array $routePath
     * @param ConfigLoader $configLoader
     */
    public function init(array $routePath, ConfigLoader $configLoader)
    {
        $this->configLoader = $configLoader;
        if (isset($routePath['module'], $routePath['controller'], $routePath['action'])) {
            $this->routePath = $routePath;
            $this->setFlag(self::FLAG_PREPARE);
        }
    }

    /**
     * @param string | null $path
     * @return AbstractController | bool | null
     * @throws \Exception
     */
    public function getController($path = null)
    {
        $this->checkFlag(self::FLAG_PREPARE);

        if ($this->controller instanceof AbstractController) {
            return $this->controller;
        }

        $config = $this->configLoader->getConfig();
        $module = $config['routes'][$this->routePath['module']];
        if (isset($module[Module::CONTROLLERS_PATH][$this->routePath['controller']])) {
            $this->controllerConfig = $module[Module::CONTROLLERS_PATH][$this->routePath['controller']];
            $this->controller = Repo::getController(
                $module[ConfigLoader::MODULE_PATH],
                $this->controllerConfig['name'],
                $path
            );
            $this->controller->init();
            return $this->controller;
        } else {
            throw new \Exception('Controller: ' . $this->routePath['controller'] . ' not found');
        }
    }

    public function getActionName()
    {
        if ($this->actionName) {
            return $this->actionName;
        }
        $notFound = false;

        if ($this->hasFlag(self::FLAG_PREPARE)
            && $this->controller instanceof AbstractController
            && $this->controller->hasFlag(self::FLAG_INIT)
            && $this->controllerConfig
        ) {
            if ($this->routePath['action'] && isset($this->controllerConfig['actions']['list'])) {
                if (in_array($this->routePath['action'], $this->controllerConfig['actions']['list'])) {
                    $this->actionName = $this->routePath['action'] . self::ACTION_SUFFIX;
                } else {
                    $this->actionName = $notFound;
                }
            } else {
                if (isset($this->controllerConfig['actions']['default'])) {
                    $this->actionName = $this->controllerConfig['actions']['default'] . self::ACTION_SUFFIX;
                } else {
                    $this->actionName = $notFound;
                }
            }
        }

        if ($this->actionName && !method_exists($this->controller, $this->actionName)) {
            $this->actionName = $notFound;
        }

        return $this->actionName;
    }
}
