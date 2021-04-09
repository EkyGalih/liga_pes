<?php

namespace App\Http\Middleware;

use App\Helper\UserAccess;
use Closure;
use Illuminate\Support\Facades\Auth;

class isUser
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
        if (Auth::check())
        {
            if (UserAccess::getRole() == 'user')
            {
                return ($next($request));
            }
        }

        return redirect()->route('not_found');
    }
}
