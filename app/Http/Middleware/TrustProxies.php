<?php

// Import necessary namespaces
namespace App\Http\Middleware;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

// Define the TrustProxies class, which extends the TrustProxies middleware provided by Laravel
class TrustProxies extends Middleware
{
    // Define a protected property to hold the trusted proxies for this application
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    // Define a protected property to hold the headers that should be used to detect proxies
    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        // List of headers that can be used to detect proxies
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}

