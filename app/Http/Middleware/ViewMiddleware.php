<?php

namespace App\Http\Middleware;

use Closure;

class ViewMiddleware
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
        setlocale(LC_MONETARY, 'de_DE.UTF-8');
        $path = $request->getPathInfo();
        view()->share('url', $path);

        return $next($request);
    }
}
