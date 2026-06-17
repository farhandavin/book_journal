<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LighthouseTestingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');

        // Check if the request is coming from Lighthouse
        if ($userAgent && str_contains($userAgent, 'Chrome-Lighthouse')) {
            // Smart bypass: login as Admin for /admin routes, normal user for others
            if (!Auth::check()) {
                if ($request->is('admin*')) {
                    // Jika mengakses rute admin, login sebagai admin
                    $user = User::where('role', 'admin')->first();
                } else {
                    // Jika mengakses rute biasa, login sebagai user biasa
                    $user = User::where('role', '!=', 'admin')->first() ?? User::first();
                }

                if ($user) {
                    Auth::login($user);
                }
            }
        }

        return $next($request);
    }
}
