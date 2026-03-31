<?php

use app\controllers\AuthController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** @var Router $router */
/** @var Engine $app */

$authController = new AuthController($app);

$router->group('', function(Router $router) use ($authController, $app) {

    $router->get('/', function() use ($app) {
        $app->render('model.php', ['page' => 'home.php']);
    });



}, [SecurityHeadersMiddleware::class]);