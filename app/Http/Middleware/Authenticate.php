<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $check_admin_url = str_contains($request->fullUrl(), "admin");
        if ($check_admin_url){
            return route('admin.login');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
