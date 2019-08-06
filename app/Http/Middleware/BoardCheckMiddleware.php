<?php

namespace App\Http\Middleware;

use Closure;

class BoardCheckMiddleware
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
        $session = $request->session;
        if (!($session->get('userData')) || !$session->get('userData')['is_board']) {
            return redirect('');
        }

        return $next($request);
    }
}
