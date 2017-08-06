<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/3/2017
 * Time: 08:51 AM
 */

namespace Core;

abstract class FlagObject
{
    const FLAG_INIT     = 'init';
    const FLAG_PREPARE  = 'prepare';

    /**
     * @var array
     */
    protected $flag = [];

    /**
     * @param string $key
     */
    protected function setFlag($key)
    {
        $this->flag[$key] = true;
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function hasFlag($key)
    {
        return isset($this->flag[$key]);
    }

    /**
     * @param string $key
     * @throws \Exception
     */
    protected function checkFlag($key)
    {
        if (!$this->hasFlag($key)) {
            throw new \Exception('Flag ' . $key . ' don\'t set');
        }
    }

    /**
     * @param $key
     */
    protected function unsFlag($key = null)
    {
        unset($this->flag[$key]);
    }
}
