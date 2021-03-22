<?php
require __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$controllers = new SiteController();

$app->router->get('/', [$controllers, 'home']);

$app->router->get('/contact', [$controllers, 'contact']);
$app->router->post('/contact', [$controllers, 'handleContact']);


$app->run();