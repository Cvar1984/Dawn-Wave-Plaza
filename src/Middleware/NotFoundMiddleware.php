<?php

namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

/**
 * Class: NotFoundMiddleware
 *
 */
class NotFoundMiddleware
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
        } catch (HttpNotFoundException  $e) {
            $response = (new Response())->withStatus(404);
            $view = Twig::fromRequest($request);
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
}
