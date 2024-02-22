<?php

// Define the namespace for the class
namespace App\Http\Middleware;

// Import the EncryptCookies middleware class from Illuminate\Cookie\Middleware
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

// Define the EncryptCookies class, which extends the EncryptCookies middleware class
class EncryptCookies extends Middleware
{
    // Define a protected property $except, which is an array of cookie names that should not be encrypted
    protected $except = [
        //
    ];
}

