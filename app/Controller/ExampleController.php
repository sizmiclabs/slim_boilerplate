<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use DI\Container;
use Aws\Sns\SnsClient as SnsClient;


class ExampleController extends Controller
{
    public function dologin($request, $response, $args)
    {
    global $db;

     $data = $request->getParsedBody();
     
     
       return $response
             ->withHeader('Location', "/")
             ->withStatus(302);

      //  return $this->view->render($response, 'response.twig', $data);
       
     }

    public function logout($request, $response, $args) {
    unset($_SESSION['auth']);
    return $response
        ->withHeader('Location', "/")
        ->withStatus(302);
    }
}