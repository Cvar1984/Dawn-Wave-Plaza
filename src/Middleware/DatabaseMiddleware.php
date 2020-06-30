<?php

namespace App\Middleware;

use Slim\Psr7\Response;
use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Illuminate\Database\QueryException;

/**
 * Class: DatabaseMiddleware
 *
 */
class DatabaseMiddleware
{
    /**
     * __invoke
     *
     * @param Request $request
     * @param Handler $handler
     */
    public function __invoke(Request $request, Handler $handler)
    {
        try {
            return $handler->handle($request);
        } catch (QueryException  $e) {
            $response = (new Response())->withStatus(404);
            $view = Twig::fromRequest($request);
            $view->render(
                $response,
                'home.html.twig',
                [
                    'title' => 'Database Error',
                    'button' => 'Fuck go back',
                    'database_error' => true,
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
}
