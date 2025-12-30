<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @author   Taylor Otwell <taylor@laravel.com>
 */

// Define constant to indicate we're running from public directory (php artisan serve)
if (!defined('LARAVEL_START_FROM_PUBLIC')) {
    define('LARAVEL_START_FROM_PUBLIC', true);
}

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.

// First, check if it's a static asset file (has a file extension like .css, .js, .png, etc.)
// Static assets should be served directly, even if they're under /admin/
$staticFileExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'map', 'json'];
$hasFileExtension = false;
foreach ($staticFileExtensions as $ext) {
    if (preg_match('#\.'.$ext.'(\?.*)?$#i', $uri)) {
        $hasFileExtension = true;
        break;
    }
}

// If it's a static file and exists, serve it directly
if ($hasFileExtension && $uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // Let PHP built-in server serve the static file
}

// Always route /admin requests to Laravel (even if directory exists)
// This handles actual admin routes like /admin, /admin/dashboard, etc.
if (preg_match('#^/admin(/.*)?$#', $uri)) {
    require_once __DIR__.'/index.php';
    return;
}

// For all other requests, check if file exists and serve it, otherwise route to Laravel
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // Let PHP built-in server serve the file
}

require_once __DIR__.'/index.php';
