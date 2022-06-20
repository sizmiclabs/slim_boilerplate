<?php

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/ez_sql_core.php';
require __DIR__ . '/../vendor/ez_sql_mysqli.php';
use DI\Container;

return function (Container $container) {
    global $db;
    $container->set('connection', function() use ($container) {
        $connection = $container->get('config')['connection'];

        $host = $connection['host'];
        $dbname = $connection['dbname'];
        $dbuser = $connection['dbuser'];
        $dbpass = $connection['dbpass'];
        // $charset = $connection['charset'];

    
        $db = new ezSQL_mysqli($dbuser, $dbpass,$dbname,$host);

        return $db;
        // $container->set('connection', function() use ($app, $container) {
        //     $db = $container->get('connection');
        //     return $db;
        // });
    });
};
