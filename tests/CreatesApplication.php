<?php

// Namespace declaration for the trait
namespace Tests;

// Import necessary classes and interfaces
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

// Defining the CreatesApplication trait
trait CreatesApplication
{
    // Method to create the application instance
    public function createApplication(): Application
    {
        // Include the bootstrap/app.php file and store the returned application instance in the $app variable
        $app = require __DIR__.'/../bootstrap/app.php';

        // Bootstrap the application by calling the bootstrap method on the Kernel instance
        $app->make(Kernel::class)->bootstrap();

        // Return the application instance
        return $app;
    }
}

