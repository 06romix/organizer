<?php
/**
 * Created by PhpStorm.
 * User: romix
 * Date: 8/1/2017
 * Time: 01:11 AM
 */
namespace Api\User\Controller;

use Api\Core\Model\Request;
use Core\Controller\AbstractController;

class AuthController extends AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    public function init()
    {
        $this->request = new Request();
        $this->setFlag(self::FLAG_INIT);
    }

    public function loginAction()
    {
        $params = $this->request->getParams();
        if (isset($params[0], $params[1])) {
            echo json_encode(['login' => $params[0], 'pass' => $params[1]]);
        } else {
            echo json_encode(['error' => 'login or pass not found']);
        }
    }
}
