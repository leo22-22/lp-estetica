<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->get('admin_authenticated')) {
            session(['url.intended' => $request->fullUrl()]);
            return redirect()->route('login');
        }

        return $next($request);
    }
}
