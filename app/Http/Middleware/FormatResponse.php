<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class FormatResponse
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
        $response = $next($request);
        if (!($response instanceof JsonResponse)) {
            return $response;
        }
        $data = $response->original;
        $response->setStatusCode($data['code']);
        return $response;
    }
}
