<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Vérifier si l'utilisateur a l'un des rôles requis
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Rediriger vers le dashboard approprié selon le rôle
        return $this->redirectToDashboard($user->role);
    }

    /**
     * Rediriger vers le dashboard approprié selon le rôle
     */
    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('dashboard');
            case 'editeur':
                return redirect()->route('editor.dashboard');
            case 'lecteur':
                return redirect()->route('reader.dashboard');
            default:
                return redirect()->route('reader.dashboard');
        }
    }
}