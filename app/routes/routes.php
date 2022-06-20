<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use DI\Container;
use App\Controller\ExampleController;
use App\Controller\DashboardController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$db = $container->get('connection');



return function (App $app) {

    $container = $app->getContainer();

    $app->group('', function ($group) {

        $group->get('/login', DashboardController::class . ':login');

    })->add(new GuestMiddleware($container));


    $app->group('', function ($group) {

        $group->get('/logout', ExampleController::class . ':logout');
        $group->get('/dashboard', ExampleController::class . ':dashboard');

    })->add(new AuthMiddleware($container));    
    
    $app->group('', function ($group) {

        // APP API
        // $group->get('/get-customer-points/{cid}', ExampleController::class . ':function_name');
        
    });
};

