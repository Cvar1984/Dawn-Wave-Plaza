<?php

return function (\Slim\App $app, \Psr\Container\ContainerInterface $container):void {
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
    $app->add($container->get(\ErrorMiddleware::class));
    // Add Twig-View Middleware
    $app->add(\Slim\Views\TwigMiddleware::create($app, $container->get(\Twig::class)));
};
