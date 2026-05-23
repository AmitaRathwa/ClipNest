<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
          if (!session()->has('user_id')) {

            session(['redirect_after_login' => url()->current()]);

            return redirect()->route('user_login');
        }

        // Check subscription
        $isSubscribed = session()->get('is_subscribed');

        if (!$isSubscribed) {
            return redirect()->route('subscription');
        }

        return $next($request);
    }
}
