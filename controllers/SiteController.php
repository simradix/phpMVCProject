<?php /** src/Controller/Home.php */
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * SiteControllers class
 * 
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home() 
    {
        $params = [
            "name" => "PHPMVC"
        ];
        return $this->render('home', $params);
    }
 
    public function contact() 
    {
        return $this->render('contact');
    }
    
    public function handleContact(Request $request) 
    {
        $body = $request->getBody();
    }
}