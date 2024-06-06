<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedecinMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'MEDECIN' || Auth::user()->role == 'MEDECINCHEF' || Auth::user()->role == 'INFIRMIER'){
            return $next($request);
        }
        return response("Vous n'etes pas autorise a visite cette page. cette dernirer n'est accecible qu'aux utilisateur ayant le profil PERSONNELSOIGNANT");
    }
}
