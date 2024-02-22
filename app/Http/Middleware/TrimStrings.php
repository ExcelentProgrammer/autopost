<?php

// Define the namespace for the class
namespace App\Http\Middleware;

// Import the TrimStrings middleware class from Illuminate\Foundation\Http\Middleware
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

// Define the TrimStrings class that extends the Middleware class
class TrimStrings extends Middleware
{
    // Define a protected property $except that is an array of strings
    protected $except = [
        // The following attributes should not be trimmed
        'current_password',
        'password',
        'password_confirmation',
    ];
}

