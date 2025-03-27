<?php
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/Views');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache',
    'debug' => true
]);

session_start();

$router = new \App\Core\Router();

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@login');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/events', 'EventController@index');
$router->add('GET', '/shop', 'ShopController@index');

$router->dispatch();
