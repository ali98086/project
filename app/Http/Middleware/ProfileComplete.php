<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //if user logined by email
        if(!empty(Auth::user()->email) && empty(Auth::user()->mobile) && empty(Auth::user()->email_verified_at)){

            return redirect()->route('customer.salesProcess.profile');

        }

        if(empty(auth()->user()->first_name) || empty(auth()->user()->last_name) || empty(auth()->user()->national_code)){

            return redirect()->route('customer.salesProcess.profile');

        }

        if(!empty(Auth::user()->mobile) && empty(Auth::user()->email) && empty(Auth::user()->mobile_verified_at)){

            return redirect()->route('customer.salesProcess.profile');

        }

        return $next($request);
    }
}
