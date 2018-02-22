<?php
/**
 * Created by PhpStorm.
 * User: mesija
 * Date: 22.02.18
 * Time: 22:14
 */
namespace tests\Api\Core\Config;

use \Api\Core\Config;

class ModuleTest extends \PHPUnit_Framework_TestCase
{

    public function testGetConfig()
    {
        $module = new Config\Module();
        $this->assertArrayHasKey('controllers', $module->getConfig());
    }
}
