<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'paths' => ['/*', 'sanctum/csrf-cookie'], // or just '*' if you want to allow all paths
    'allowed_methods' => ['GET', 'POST', 'OPTIONS'],  // Allow all methods (GET, POST, PUT, DELETE, etc.)
    'allowed_origins' => ['http://localhost:3000'],  // React frontend URL
    'allowed_headers' => ['Origin', 'Content-Type', 'Accept', 'X-XSRF-TOKEN', 'X-Requested-With', 'Authorization'],
    'exposed_headers' => ['X-Total-Count'],
    'allow_credentials' => true,  // Allow cookies
    'max_age' => 3600,
    'supports_credentials' => true,
];
