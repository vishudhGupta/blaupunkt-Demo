<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// All Laravel app files live in _laravel/ subfolder inside public_html
$appPath = __DIR__ . '/_laravel';

// Maintenance mode check
if (file_exists($maintenance = $appPath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoloader
require $appPath . '/vendor/autoload.php';

// Bootstrap and handle request
$app = require_once $appPath . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
