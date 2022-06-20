<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class GuestMiddleware extends Middleware
{

	public function __invoke(Request $request, RequestHandler $handler): Response
	{
		$response = $handler->handle($request);
		if($this->container->get('auth')->check()) {
			// return $response->withRedirect($this->container->get('router')->urlFor('home'));
			return $response
		            ->withHeader('Location', "/")
		            ->withStatus(302);
		}

		
        return $response;
	}
}