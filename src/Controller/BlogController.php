<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class BlogController
{
    public function __invoke(Request $request, Response $response) : Response
    {
        // just test if twig is working
        $view = \Slim\Views\Twig::fromRequest($request);
        $view->render(
            $response,
            'blog.html.twig',
            [
                'title' => 'Blog pages',
                'app_name' => 'Slim Twig',
                'article_title' => 'Article Title',
                'article_lead' => 'Article lead',
                'article_preview' => 'Article preview...',
                'article_meta' => 'Cvar1984',
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
