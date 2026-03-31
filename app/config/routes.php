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
        $app->render('auth/model.php', ['page' => 'home.php']);
    });

    $router->get('/login', function() use ($app) {
        $app->render('auth/model.php', ['page' => 'login.php']);
    });

    $router->get('/register', [$authController, 'showRegister']);

    $router->post('/register', [$authController, 'postRegister']);

    $router->post('/api/validate/register', [$authController, 'validateRegisterAjax']);

}, [SecurityHeadersMiddleware::class]);