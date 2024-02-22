<?php

// Namespace declaration for the class
namespace App\Http\Middleware;

// Importing the PreventRequestsDuringMaintenance middleware class from Illuminate\Foundation\Http\Middleware
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

// Defining the PreventRequestsDuringMaintenance class which extends the Middleware class
class PreventRequestsDuringMaintenance extends Middleware
{
    // Defining a protected property $except which is an array of URIs that should be reachable while maintenance mode is enabled
    protected $except = [
        // Empty array to be filled with specific URIs as needed
    ];
}

