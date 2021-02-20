<?php

namespace App\Http\Middleware;

use App\Exceptions\AppleAuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Class AppleAuthenticate.
 */
class AppleAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route(home_route());
        }
    }
}
