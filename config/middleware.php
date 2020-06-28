<?php

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;
use Psr\Container\ContainerInterface as Container;

return function (App $app, Container $container):void {
    // optional sub directory
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();
    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();
    // Not found handler
    $app->add(\App\Middleware\NotFoundMiddleware::class);
    // database handler
    $app->add(\App\Middleware\DatabaseMiddleware::class);
    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
    // Add Twig-View Middleware
    $app->add(TwigMiddleware::create($app, $container->get(Twig::class)));
};
