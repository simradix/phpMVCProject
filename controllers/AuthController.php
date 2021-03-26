<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

/**
 * AuthController class
 * 
 * @package
 */
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayoutName('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            
            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }

            echo '<pre>';
            var_dump($registerModel->errors);
            echo '</pre>';
            exit;
            $this->setLayoutName('auth');
            return $this->render('register', [
                'model' => $registerModel
            ]);
        }
        $this->setLayoutName('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
