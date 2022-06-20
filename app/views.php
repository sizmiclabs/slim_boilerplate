<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Loader\FilesystemLoader;

return function (App $app) {
    $container = $app->getContainer();

    // $container->set('view', function() use ($container) {
    //     $settings = $container->get('config')['views'];
    //     $loader = new FilesystemLoader($settings['path']);

    //     return new Twig($loader, $settings['settings']);
    // });


    $container->set('view', function() use ($container) {
        $settings = $container->get('config')['views'];
        $loader = new FilesystemLoader($settings['path']);

        $twig = new Twig($loader, $settings['settings']);

        // $twig = new Twig($loader, $settings['settings'], ['cache' => false]);

	    $environment = $twig->getEnvironment();
        
	    $environment->addGlobal('session', $_SESSION);

        $environment->addGlobal('flash', $container->get('flash'));

        // $twig = new Twig_Environment($loader, array(
        //     'cache' => false,
        // ));

        return $twig;
    });

    

    $container->set('viewMiddleware', function() use ($app, $container) {
        return new TwigMiddleware($container->get('view'), $app->getRouteCollector()->getRouteParser());
    });
};
