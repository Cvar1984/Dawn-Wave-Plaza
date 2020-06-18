<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeController
{
    public function __invoke(Request $request, Response $response) : Response
    {
        // just test if twig is working
        $view = \Slim\Views\Twig::fromRequest($request);
        $view->render(
            $response,
            'home.html.twig',
            [
                'title' => 'Home pages',
                'button' => 'Take a coffe',
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
