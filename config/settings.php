<?php

// Error reporting for production
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['public'] = $settings['root'] . '/public';
$settings['templates'] = $settings['root'] . '/templates';
$settings['cache'] = [
    'twig' => $settings['root'] . '/cache',
    'route' => $settings['root'] . '/cache/route_cache.php'
];

$settings['assets'] = [
    // Public assets cache directory
    'path' => $settings['public'] . '/assets/local/cache',
    'url_base_path' => '/assets/local/cache/',
    //  Should be set to 1 (enabled) in production
    'minify' => 1,
];

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];
// database
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'sqlim',
    'username' => 'user',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];
//
return $settings;
