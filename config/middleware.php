<?php

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;
use Slim\Psr7\Response;
use Slim\Exception\HttpNotFoundException;
use Psr\Container\ContainerInterface as Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

return function (App $app, Container $container):void {
    // optional sub directory
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();
    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();
    // Not found handler
    $app->add(
        function (Request $request, Handler $handler) {
            try {
                return $handler->handle($request);
            } catch (HttpNotFoundException  $e) {
                $response = (new Response())->withStatus(404);
                $view = \Slim\Views\Twig::fromRequest($request);
                $view->render(
                    $response,
                    'home.html.twig',
                    [
                        'title' => 'Page can\'t be found',
                        'button' => 'Fuck go back',
                        'not_found' => true,
                        'links' => [
                            'home' => '/home',
                            'profile' => '/profile',
                            'about' => '/about',
                            'blog' => '/blog',
                        ]
                    ]
                );
                return $response;
            }
        }
    );
    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
    // Add Twig-View Middleware
    $app->add(TwigMiddleware::create($app, $container->get(Twig::class)));
};
