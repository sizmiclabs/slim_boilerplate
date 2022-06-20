<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
use App\Middleware\ExampleBeforeMiddleware;
use Socialite\Socialite;
use App\Middleware\AuthMiddleware;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/ses.php';

// ini_set('session.use_trans_sid', 1); 
ini_set('session.use_cookies', 1); 
ini_set('session.use_only_cookies', 0);

ini_set('session.gc_maxlifetime', 36000);
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(1);
// error_reporting(E_ALL & ~E_NOTICE);

// echo "After session start";
// print_r($_GET);
// print_r($_SESSION['auth']);
// die();


$container = new Container();

$settings = require __DIR__ . '/../app/config.php';
$settings($container);

$connection = require __DIR__ . '/../app/connection.php';
$connection($container);

$globarVars = array();


$logger = require __DIR__ . '/../app/logger.php';
$logger($container);

// $container->set('router', function () use ($routeParser) {
//     return $routeParser;
// });

$container->set('auth', function() {
	return new \App\Auth\Auth;
});
$container->set('helper', function() {
	return new \App\Helper;
});

$container->set('flash', function() {
	return new \Slim\Flash\Messages;
});

// Set Container on app
AppFactory::setContainer($container);


$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$responseFactory = $app->getResponseFactory();

// $routeCollector = $app->getRouteCollector();
// $routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());
$routeParser = $app->getRouteCollector()->getRouteParser();

$views = require __DIR__ . '/../app/views.php';
$views($app);

$routes = require __DIR__ . '/../app/routes/routes.php';
$routes($app);

// $app->get('/', function (Request $request, Response $response, array $args) {
//     global $db;
// 	echo "aa";
	
// 	$response->getBody()->write('aa');
// 	return $response;
// });

//test
// $app->get('/test-controllers', Pipeline::class)->setName('auth.signin');;

// $app->group('', function ($group) {

// 	$group->get('/test-controllers-home', HomeController::class . ':home');

// })->add(new AuthMiddleware($container));


require __DIR__ . '/../app/helper.php';
$app->run();