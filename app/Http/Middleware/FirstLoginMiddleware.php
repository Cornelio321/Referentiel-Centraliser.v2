<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FirstLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Vérifier si l'utilisateur doit changer son mot de passe
            if (is_null($user->password_changed_at)) {
                // Éviter la redirection infinie sur la page de changement de mot de passe
                if (!$request->routeIs('password.change') && !$request->routeIs('password.update') && !$request->routeIs('logout')) {
                    return redirect()->route('password.change')
                        ->with('warning', 'Vous devez changer votre mot de passe avant de continuer.');
                }
            }
        }

        return $next($request);
    }
}