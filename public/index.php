<?php
require __DIR__ . '/../vendor/autoload.php';
use app\core\Application;

$app = new Application();

$app->router->get('/', function() {
    return 'Hello World';
});

$app->router->get('/user', function() {
    return 'Hello User';
});


$app->run();