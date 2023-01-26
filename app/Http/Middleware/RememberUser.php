<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RememberUser
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::viaRemember()){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
