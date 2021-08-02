<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return redirect()->to("admin/login");

    }

    public function logout() {
        Auth::logout();
        return redirect('admin/login');
    }
}
