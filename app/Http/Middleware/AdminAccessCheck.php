<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminAccessCheck
{
    /**
     * Check if current user has user_type == admin
     * All admin routes should be executed through this middleware
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user() && auth()->user()->type == User::ADMIN_TYPE) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
