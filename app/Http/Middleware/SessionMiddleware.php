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

        if (is_null($request->session->get('userData'))) {
            view()->share('login_user', '');
        } else {
            view()->share('login_user', $request->session->get('userData'));
        }

        return $next($request);
    }
}
