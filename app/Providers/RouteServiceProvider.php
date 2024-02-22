<?php

// Namespace declaration for the RouteServiceProvider class
namespace App\Providers;

// Import necessary classes and interfaces
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Define the RouteServiceProvider class
class RouteServiceProvider extends ServiceProvider
{
    // Constant to hold the path to the "home" route
    public const HOME = '/home';

    /**
     * Bootstrap any application services.
     *
     * This method is called after all other service providers have been registered,
     * so you are free to add your own initialization logic here.
     */
    public function boot(): void
    {
        // Configure rate limiting for the API endpoint
        RateLimiter::for('api', function (Request $request) {
            // Limit requests to 60 per minute, identified by the user's ID or IP address
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Define routes for the application
        $this->routes(function () {
            // Group API routes with the "api" middleware and prefix with "api"
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Group web routes with the "web" middleware
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

