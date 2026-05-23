<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('admin_id')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
