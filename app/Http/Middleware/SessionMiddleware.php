<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\SessionHelper;

class SessionMiddleware
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
        // Add a session onto the request
        $request->merge(["session" => new SessionHelper()]);
        return $next($request);
    }
}
