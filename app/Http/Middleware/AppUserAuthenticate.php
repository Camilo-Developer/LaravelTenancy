<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AppUserAuthenticate
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('appuser')->check()){
            return redirect()->route('app.admin.login');
        }
        return $next($request);
    }
}
