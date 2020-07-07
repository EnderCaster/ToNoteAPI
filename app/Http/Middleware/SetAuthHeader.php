<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Passport;

class SetAuthHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = Passport::cookie();
        if ($request->hasCookie($key)) {
            $request->headers->set("Authorization", "Bearer " . trim($request->cookie($key)));
        }
        return $next($request);
    }
}
