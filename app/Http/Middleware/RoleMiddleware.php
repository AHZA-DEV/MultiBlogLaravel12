<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            // Clear any existing session data
            $request->session()->flush();
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        if (!$user || $user->role !== $role) {
            Auth::logout();
            $request->session()->flush();
            abort(403, 'Akses tidak diizinkan. Anda tidak memiliki hak akses yang diperlukan.');
        }

        return $next($request);
    }
}
