<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 09:01 PM
 */

namespace Api\Core\Model;

use Core\Repo;

class Request extends \Core\Model\Request
{
    public function __construct()
    {
        parent::__construct();
        $this->url = Repo::getModel(Url::class);
    }
}
