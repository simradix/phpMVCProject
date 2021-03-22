<?php /** src/Controller/Home.php */
namespace app\controllers;

use app\core\Application;

/**
 * SiteControllers class
 * 
 * @package app\controllers
 */
class SiteController
{
    public function home() 
    {
        $params = [
            "name" => "PHPMVC"
        ];
        return Application::$app->router->render('home', $params);
    }
 
    public function contact() 
    {
        return Application::$app->router->render('contact');
    }
    
    public function handleContact() 
    {
        return "Handling submitted contact data.";
    }
}