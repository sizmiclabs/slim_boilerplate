<?php
namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use DI\Container;

class DashboardController extends Controller
{
  
  public function login($request, $response, $args) {     
    return $this->view->render($response, 'login.twig');
  }

}



