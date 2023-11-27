<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;

class RedirectCheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();
        /**
         * Handle an incoming request.
         *
         * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
         */

        // Pengecekan apakah permintaan berasal dari perangkat mobile
        if ($agent->isMobile()) {
            if(Auth::User()->account_type != 'USR') {
                return redirect()->route('error_mobile');
            }
        }else if ($agent->browser()) {
            if(Auth::User()->account_type != 'ADM') {
                return redirect()->route('error_browser');
            }
        }

        return $next($request);
    }
}
