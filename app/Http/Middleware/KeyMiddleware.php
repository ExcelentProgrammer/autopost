<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;

class KeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->input("key");
        if ($key != Env::get("API_KEY"))
            throw new HttpResponseException(\Illuminate\Support\Facades\Response::json("permission denied"));
        return $next($request);
    }
}
