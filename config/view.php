<?php

// Return an array containing view configuration options for the Laravel framework.
return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | This array specifies the paths that should be checked for view files.
    | The default Laravel view path is already registered in the array.
    |
    */

    'paths' => [
        resource_path('views'), // The path to the views directory
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. By default, this is within the storage
    | directory. However, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH', // The environment variable for the compiled view path
        realpath(storage_path('framework/views')) // The default compiled view path
    ),

];

