<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 09:49 AM
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

const CD = '\\';
const FD = '/';
const BASEDIR = __DIR__ . FD . 'src';

require_once 'vendor/autoload.php';

$app = new \Api\App();
$app->run();
