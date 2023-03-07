<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VerificarLogin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::check()) {
            if ($user->cad_concluir == 0) {
                return Redirect::route('user.complete');
            } else {
                return $next($request);
            }
        } else {
            return Redirect::route("login"); 
        }
        
    }
}
