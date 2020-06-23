<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface as Container;
use Illuminate\Database\Connection;

final class BlogController
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function __invoke(Request $request, Response $response) : Response
    {
        $db = $this->container->get(Connection::class);
        $rows = $db->table('tb_blog')->get();

        foreach ($rows as $key => $row) {
            $articlesTitle[] = strtoupper($row->article_title);
            $articlesMeta[] = $row->article_meta;
            $articlesLead[] = $row->article_lead;
            $articlesLink[] = str_replace(' ', '-', strtolower($row->article_link));
            $articlesPreview[] = substr($articlesLead[$key], 0, 50);
        }

        $view = \Slim\Views\Twig::fromRequest($request);
        $view->render(
            $response,
            'blog.html.twig',
            [
                'title' => 'Blog pages',
                'articles' => [
                    'titles' => $articlesTitle,
                    'previews' => $articlesPreview,
                    'metas' => $articlesMeta,
                    'links' => $articlesLink
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
