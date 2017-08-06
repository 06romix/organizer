<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 08:59 PM
 */

namespace Api\Core\Model;

use Api\Router;

class Url extends \Core\Model\Url
{
    public function __construct()
    {
        $this->directory = Router::PATH;
    }

    public function parsePath($path)
    {
        return parent::parsePath($path);
    }
}
