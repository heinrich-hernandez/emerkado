<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSysUsers
{
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    

    public function handle($request, Closure $next, $guard = null)
    {

        // if (!Auth::guard($guard)->check()) {
        //     \Log::warning('Not logged in.');
        //     return redirect()->route('getLogin')->with('error', 'You must be logged in to access this page.');
        // }


        $user = Auth::guard($guard)->user();
        // $guard = Auth::guard($guard)->check();
        // Check if the user's status is 'Approved'
        // \Log::info('AuthenticateSysUsers Guard: '.$guard);
        // if ($user->status == 'Approved') {
        //     \Log::info('AuthenticateSysUsers: Approved');
        //     return $next($request);
        // }

        if (Auth::guard($guard)->check()) {
            if ($user->status == '1') {
                    \Log::info('AuthenticateSysUsers: Approved Guard Check');
                    return $next($request);
                }
        }
        else{
            // \Log::info('AuthenticateSysUsers: Disapproved Guard Check');
            return redirect()->route('getLogin')->with('error','Must be logged in to access this page'); //this line of code is being disregarded, all unauthenticated routes are being executed in \coop\laravel\framework\src\Illuminate\Auth\Middleware\Authenticate.php
            // return $request->expectsJson() ? null : route('getLogin'); // <--- !
        }
        
        // Log out and redirect to login page if the user is not approved
        // Auth::guard($guard)->logout();
        // return redirect()->route('getLogin')->with('error', 'Your account is not approved.');
    }
}
