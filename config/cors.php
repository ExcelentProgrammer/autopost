<?php

// Return an array containing the CORS configuration settings
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This section contains the settings for cross-origin resource sharing
    | or "CORS". CORS determines what cross-origin operations may execute
    | in web browsers. You can adjust these settings as needed.
    |
    | For more information: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // The URL paths that are allowed to make cross-origin requests
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // The HTTP methods that are allowed for cross-origin requests
    'allowed_methods' => ['*'], // Allows all methods

    // The origins that are allowed to make cross-origin requests
    'allowed_origins' => ['*'], // Allows all origins

    // A list of regular expressions that match the origins that are allowed
    // to make cross-origin requests. This is an alternative to the 'allowed_origins'
    // setting and takes precedence over it.
    'allowed_origins_patterns' => [],

    // The HTTP headers that are allowed for cross-origin requests
    'allowed_headers' => ['*'], // Allows all headers

    // The HTTP headers that will be exposed in the response to a cross-origin
    // request. This is an array of header names.
    'exposed_headers' => [],

    // The maximum amount of time, in seconds, that the results of a preflight
    // request (a CORS request that checks to see if the actual request is allowed)
    // can be cached.
    'max_age' => 0, // No caching

    // Whether to allow credentials (e.g. cookies) to be included in cross-origin
    // requests.
    'supports_credentials' => false, // Do not allow credentials

];

