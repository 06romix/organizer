<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 09:09 AM
 */

namespace Api\User;


interface Auth
{
    public function login();
    public function register();
    public function logout();
}
