<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckForPriceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->url('products/checkout') OR $request->url('products/pay') OR $request->url('products/success') ) {
            if(Session::get('price') == 0) {
                return abort(403, 'Unauthorized Action!!!');
            }
        }

        return $next($request);
    }
}
