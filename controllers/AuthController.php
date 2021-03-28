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
                // return 'Success';
                echo 'Success';
            }

            // echo '<pre>';
            // var_dump($registerModel->errors);
            // echo '</pre>';
            
            // echo '<pre>';
            // var_dump($registerModel->firstname);
            // var_dump($registerModel->lastname);
            // var_dump($registerModel->email);
            // var_dump($registerModel->password);
            // var_dump($registerModel->passwordConfirm);
            // echo '</pre>';
            // exit;
            
            
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
