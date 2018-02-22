<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 09:45 AM
 */

namespace Core;

use Api\App;
use Core\Model\Request;

class Router extends FlagObject
{
    /**
     * @var Request
     */
    protected $request;

    protected $path = null;

    /**
     * @var array
     */
    protected $routePath = [
        'module' => null,
        'controller' => null,
        'action' => null,
    ];

    public function __construct()
    {
        $this->request = Repo::getModel(Request::class);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function match()
    {
        $this->_prepareRouteParams($this->request->getRouteParams());

        $routeConfig = App::getRouteConfig();
        $routeConfig->init($this->routePath, Repo::get(ConfigLoader::class));
        $controller = $routeConfig->getController($this->path);
        $actionName = $routeConfig->getActionName();
        if ($actionName) {
            $controller->$actionName();
            return true;
        } else {
            throw new \Exception('action not found');
        }
    }

    /**
     * @param array $params
     */
    protected function _prepareRouteParams(array $params)
    {
        if (!$this->hasFlag(self::FLAG_PREPARE)) {
            $this->routePath['module']      = $params[0];
            $this->routePath['controller']  = $params[1];
            $this->routePath['action']      = (isset($params[2]) ? $params[2] : null);
            $this->setFlag(self::FLAG_PREPARE);
        }
    }
}
