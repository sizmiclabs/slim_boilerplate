<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

return function (Container $container) {
    $container->set('config', function() {
        return [
            'name' => 'Slim Application',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            // 'logger' => [
            //     'name' => 'slim-app',
            //     'path' => __DIR__ . '/../logs/app.log',
            //     'level' => Logger::DEBUG,
            // ],
            'views' => [
                'path' => __DIR__ . '/../Views',
                'settings' => ['cache' => false],
            ],
            'connection' => [
                'host' => 'localhost',
                'dbname' => 'database_name',
                'dbuser' => 'root',
                'dbpass' => '1234',
            ]
        ];
    });
};