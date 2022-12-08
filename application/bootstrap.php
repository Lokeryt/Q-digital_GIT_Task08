<?php

use Application\Core\Route;

use Config\Db;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');

    if (file_exists($path)) {
        require $path;
    }
});

session_start();

Db::getInstance();

$router = new Route();
$router->run();
