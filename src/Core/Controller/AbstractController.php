<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 01:16 AM
 */

namespace Core\Controller;

use Core\FlagObject;

abstract class AbstractController extends FlagObject
{
    abstract public function init();
}