<?php
/**
 * Created by PhpStorm.
 * User: mesija
 * Date: 11.03.18
 * Time: 20:43
 */

namespace tests\Core\Model;

use Core\Model\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var null|Url
     */
    private $url = null;

    public function setUp()
    {
        $this->url = new Url();
        $this->assertInstanceOf(Url::class, $this->url);
    }

    /**
     * @dataProvider providerParsePath()
     *
     * @param $path
     * @param $result
     */
    public function testParsePath($path, $result)
    {
        $this->assertEquals($result, $this->url->parsePath($path));
    }

    /**
     * @return array
     */
    public function providerParsePath()
    {
        return [
            [
                'path'   => 'api/user/init',
                'result' => ['api', 'user', 'init']
            ],
            [
                'path'   => 'api/user',
                'result' => ['api', 'user']
            ],
            [
                'path'   => 'api/',
                'result' => ['api']
            ],
            [
                'path'   => 'api/user/',
                'result' => ['api', 'user']
            ],
            [
                'path'   => 'api/',
                'result' => ['api']
            ],
            [
                'path'   => '/user/init',
                'result' => ['user', 'init']
            ],
            [
                'path'   => '',
                'result' => false
            ],
            [
                'path'   => 'init',
                'result' => ['init']
            ],
        ];
    }
}
