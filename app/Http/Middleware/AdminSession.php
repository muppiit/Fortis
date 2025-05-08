<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('admin_login')) {
            return redirect()->route('admin.login')->with('status', 'Silakan login dulu');
        }

        return $next($request);
    }
}
