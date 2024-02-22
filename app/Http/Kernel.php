<?php

namespace App\Http;

use App\Http\Middleware\KeyMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

// The Kernel class extends the HttpKernel class provided by Laravel,
// which is the base class for all application's HTTP kernels.
class Kernel extends HttpKernel
{
    // The middleware that should be applied to every request to the application.
    protected $middleware = [
        // TrustProxies middleware is used to determine the origin of incoming requests.
        \App\Http\Middleware\TrustProxies::class,
        // HandleCors middleware is used to handle Cross-Origin Resource Sharing (CORS) requests.
        \Illuminate\Http\Middleware\HandleCors::class,
        // PreventRequestsDuringMaintenance middleware is used to prevent requests during maintenance mode.
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // ValidatePostSize middleware is used to validate the size of incoming HTTP requests.
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // TrimStrings middleware is used to trim all incoming string data.
        \App\Http\Middleware\TrimStrings::class,
        // ConvertEmptyStringsToNull middleware is used to convert empty strings to null.
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    // The middleware groups that should be applied to specific routes or route groups.
    protected $middlewareGroups = [
        'web' => [
            // EncryptCookies middleware is used to encrypt all outgoing cookies.
            \App\Http\Middleware\EncryptCookies::class,
            // AddQueuedCookiesToResponse middleware is used to add any queued cookies to the response.
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // StartSession middleware is used to start the session for the current request.
            \Illuminate\Session\Middleware\StartSession::class,
            // ShareErrorsFromSession middleware is used to share any session errors with the views.
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // VerifyCsrfToken middleware is used to verify the CSRF token for incoming requests.
            \App\Http\Middleware\VerifyCsrfToken::class,
            // SubstituteBindings middleware is used to automatically resolve model bindings.
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // KeyMiddleware is a custom middleware used to handle API requests.
            KeyMiddleware::class,
            // ThrottleRequests middleware is used to throttle incoming requests.
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            // SubstituteBindings middleware is used to automatically resolve model bindings.
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // The middleware aliases that can be used instead of class names.
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}

