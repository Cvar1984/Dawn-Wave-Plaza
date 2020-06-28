<?php

use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
//use Slim\Views\PhpRenderer;
use Slim\Views\Twig;
use Odan\Twig\TwigAssetsExtension;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Psr\Container\ContainerInterface as Container;
use Selective\Config\Configuration;

return [
    Configuration::class => function ():Configuration {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (Container $container):App {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        //$app->setBasePath('/Dawn-Wave-Plaza');
        $route = $app->getRouteCollector();
        $route->setCacheFile(
            $container
                ->get(Configuration::class)
                ->getString('cache.route')
        );
        return $app;
    },
    Twig::class => function (Container $container):Twig {
        $config = $container->get(Configuration::class);
        $twig = Twig::create(
            $config->getString('templates'),
            [
                //'cache' => $config->getString('cache.twig'),
            ]
        );

        $loader = $twig->getLoader();

        if ($loader instanceof FilesystemLoader) {
            $loader->addPath($config->getString('public'), 'public');
        }

        $env = $twig->getEnvironment();

        // Add Twig extensions
        $twig->addExtension(
            new TwigAssetsExtension($env, $config->getArray('assets'))
        );
        return $twig;
    },
    ErrorMiddleware::class => function (Container $container):ErrorMiddleware {
        $app = $container->get(App::class);
        $settings = $container
            ->get(Configuration::class)
            ->getArray('error_handler_middleware');

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },
    //    PhpRenderer::class => function(Container $container):PhpRenderer
    //    {
    //        $templateVariables = [
    //            'app_name' => 'Slim Twig',
    //            'date' => date('Y'),
    //            'link' => array(
    //                'home' => '/home',
    //                'profile' => '/profile'
    //            ),
    //        ];
    //
    //        return new PhpRenderer('../templates', $templateVariables);
    //    },
    // Database connection
    Connection::class => function (Container $container):Connection {
        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make(
            $container
                ->get(Configuration::class)
                ->getArray('db')
        );

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        return $connection;
    },
    PDO::class => function (Container $container):PDO {
        return $container->get(Connection::class)->getPdo();
    },
];
