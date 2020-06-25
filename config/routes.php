<?php

return function (\Slim\App $app) {
    $app->get('/', \App\Controller\HomeController::class);
    $app->get('/home', \App\Controller\HomeController::class);
    $app->get('/blog', \App\Controller\BlogController::class);
};
