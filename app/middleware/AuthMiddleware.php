<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class AuthMiddleware extends Middleware
{

	public function __invoke(Request $request, RequestHandler $handler): Response
	{
		if(! $this->container->get('auth')->check()) {
			$this->container->get('flash')->addMessage('error', 'Please sign in before doing that');
			// return $response->withRedirect($this->container->get('router')->urlFor('login'));
			$response = $handler->handle($request);
			return $response
		            ->withHeader('Location', "/login")
		            ->withStatus(302);
		}
		
		
		$response = $handler->handle($request);
		return $response;
	}
}



		