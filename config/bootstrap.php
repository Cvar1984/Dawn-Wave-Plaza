<?php

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(\Slim\App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// register middleware
(require __DIR__ . '/middleware.php')($app, $container);

return $app;
