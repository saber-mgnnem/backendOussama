<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiEleveMiddeware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(auth()->user()->tokenCan('server:etudiant')){
                return $next($request);

            }
            else{
                return response()->json([
                    'massage'=>"Accès refusé .! vous n'êtes pas en tant qu'etudiant",
                ],403);
            }
        }
        else{
            return response()->json([
                'status'=>401,
                'massage'=>" S'il vous plait Connectez-vous d'abord"
            ]);
        }
    }
}
