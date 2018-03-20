<?php
/**
 * Created by PhpStorm.
 * User: mesija
 * Date: 22.02.18
 * Time: 23:15
 */

namespace tests\Core\Model;

use \Core;

class RouteConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerInit
     * @param array             $routePath
     * @param Core\ConfigLoader $configLoader
     * @param bool              $fake
     */
    public function testInit(array $routePath, Core\ConfigLoader $configLoader, $fake)
    {
        $class = new Core\Model\RouteConfig();
        $this->assertEquals($fake, $class->init($routePath, $configLoader));
    }

    public function providerInit()
    {
        (new Core\Repo())->init();
        $configLoader = Core\Repo::get(Core\ConfigLoader::class);
        return [
            [
                [
                    'module' => 'user',
                ],
                $configLoader,
                false,
            ],
            [
                [
                    'module'     => 'user',
                    'controller' => 'auth',
                ],
                $configLoader,
                false,
            ],
            [
                [
                    'module'     => 'user',
                    'controller' => 'auth',
                    'action'     => null,
                ],
                $configLoader,
                true,
            ],
            [
                [
                    'module'     => 'user',
                    'controller' => 'auth',
                    'action'     => 'index',
                ],
                $configLoader,
                true,
            ],
            [
                [
                    'module'     => 'user',
                    'controller' => 'auth',
                    'action'     => 'bla-bla-bla',
                ],
                $configLoader,
                true,
            ],
            [
                [
                    'module'     => 'user',
                    'controller' => 'auth',
                    'action'     => 0,
                ],
                $configLoader,
                true,
            ],
        ];
    }
}
