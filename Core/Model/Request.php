<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 08:46 PM
 */

namespace Core\Model;

use Core\Repo;

class Request extends AbstractModel
{
    const GET_PARAM_NAME = 'params';

    /**
     * [module, controller, action, ...params]
     *
     * @var array
     */
    protected $srcParamsGET;

    /**
     * [module, controller, action]
     *
     * @var array | null
     */
    protected $paramsRoute;

    /**
     * [...params]
     *
     * @var array
     */
    protected $paramsGET = [];

    /**
     * Use for parse GET params
     *
     * @var Url
     */
    protected $url;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = Repo::getModel(Url::class);
        $this->initParams();
    }

    /**
     * @return array
     */
    public function getRouteParams()
    {
        return $this->paramsRoute;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->paramsGET;
    }

    /**
     * Init request param.
     * Parse [module, controller, action]
     * Parse other params
     *
     * @throws \Exception
     */
    protected function initParams()
    {
        if (!$this->hasFlag(self::FLAG_INIT)) {
            $this->srcParamsGET = $this->url->parsePath($this->getParamFromGET(Request::GET_PARAM_NAME));
            $count = count($this->srcParamsGET);
            if ($count < 2) {
                throw new \Exception('params < 2');
            } else {
                $this->paramsRoute = array_slice($this->srcParamsGET, 0, 3);
                if (count($this->srcParamsGET) > 3) {
                    $this->paramsGET = array_slice($this->srcParamsGET, 3);
                }
            }
            $this->setFlag(self::FLAG_INIT);
        }
    }

    /**
     * Getter for $_GET
     *
     * @param string $key
     * @return null
     */
    protected function getParamFromGET($key)
    {
        if (is_string($key) && isset($_GET[$key])) {
            return $_GET[$key];
        }

        return null;
    }
}
