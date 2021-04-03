<?php
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\User;

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
        $User = new User();
        if ($request->isPost()) {
            $User->loadData($request->getBody());
            
            if ($User->validate() && $User->save()) {
                return 'Success';
            }
                     
            $this->setLayoutName('auth');
            return $this->render('register', [
                'model' => $User
            ]);
        }
        $this->setLayoutName('auth');
        return $this->render('register', [
            'model' => $User
        ]);
    }
}
