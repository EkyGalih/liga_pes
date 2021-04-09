<?php

namespace App\Http\Middleware;

use App\Helper\UserAccess;
use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
            if (UserAccess::getRole() == 'admin')
            {
                return ($next($request));
            }
        }

        return redirect()->route('not_found');
    }
}
