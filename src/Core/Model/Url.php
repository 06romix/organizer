<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 08:47 PM
 */

namespace Core\Model;

class Url extends AbstractModel
{
    protected $directory = '';

    public function parsePath($path)
    {
        if (!$path || !is_string($path)) {
            return false;
        }

        $paramsArray = array_filter(explode('/', $path));

        if (isset($paramsArray[0]) && $paramsArray[0] === $this->directory) {
            unset($paramsArray[0]);
        }

        return array_values($paramsArray);
    }
}
