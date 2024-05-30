<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     // if (! $request->expectsJson()) {
    //     //     return route('login');
    //     // }
        

    //     // 1. Dư biến $request
       
    //     //dd(request()->is('administrator/*'));
    //     // URL: administrator/teacher-list
    //     if (! $request->expectsJson()) {
    //         if (request()->is('administrator/*') || request()->is('administrator')) {
               
    //             return route('administrator.login');
    //         }
    //         if (request()->is('teacher/*') || request()->is('teacher')) {
                
    //             return route('teacher.login');
    //         }
    //         return route('login');
    //     }

    // }
}
