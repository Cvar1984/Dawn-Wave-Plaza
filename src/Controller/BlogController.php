<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class BlogController
{

    public function __invoke(Request $request, Response $response) : Response
    {
        for($x = 0; $x<5; $x++) :
        $articlePreview[$x] = <<<EOA
Gravida neque convallis a cras

Ac turpis egestas integer eget

Tempus egestas sed sed risus

Est ullamcorper eget nulla facilisi

Euismod lacinia at quis risus.
EOA;
        $articleLead[$x] = substr($articlePreview[$x], 0, 50);
        $articleMeta[$x] = 'Cvar1984';
        $articleTitle[$x] = substr($articlePreview[$x], 0, 13);
        $articleLink[$x] = str_replace(' ', '-', $articleTitle[$x]);
        endfor;

        $view = \Slim\Views\Twig::fromRequest($request);
        $view->render(
            $response,
            'blog.html.twig',
            [
                'title' => 'Blog pages',
                'articles' => [
                    'titles' => $articleTitle,
                    'leads' => $articleLead,
                    'previews' => $articlePreview,
                    'metas' => $articleMeta,
                    'links' => $articleLink
                ],
                'links' => [
                    'home' => '/home',
                    'about' => '/about',
                    'blog' => '/blog',
                ]
            ]
        );
        return $response;
    }
}
