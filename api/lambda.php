<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Vercel-specific Runtime Configuration
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    // Force storage to /tmp (the only writable directory in Lambda)
    $app->useStoragePath('/tmp/storage');

    // Ensure storage directories exist
    if (!is_dir('/tmp/storage/framework/views')) {
        mkdir('/tmp/storage/framework/views', 0755, true);
        mkdir('/tmp/storage/framework/cache/data', 0755, true);
        mkdir('/tmp/storage/framework/sessions', 0755, true);
        mkdir('/tmp/storage/logs', 0755, true);
    }

    // Force configurations for Serverless environment
    // These override .env values to prevent crashes from read-only filesystem
    $_ENV['LOG_CHANNEL'] = 'stderr';  // Log to Vercel console
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
    $_ENV['SESSION_DRIVER'] = 'cookie'; // Safe fallback if DB fails
    $_ENV['CACHE_DRIVER'] = 'array';    // Ephemeral cache for Lambda
}

$app->handleRequest(Request::capture());
