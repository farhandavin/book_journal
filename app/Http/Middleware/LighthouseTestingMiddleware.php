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

        // Check if the request has ?lighthouse=1 OR comes from Lighthouse User-Agent
        if ($request->has('lighthouse') || ($userAgent && str_contains($userAgent, 'Chrome-Lighthouse'))) {
            // Smart bypass: create a dummy in-memory user to avoid database issues
            if (!Auth::check()) {
                $dummyUser = new User();
                $dummyUser->id = 999999;
                $dummyUser->name = 'Lighthouse Tester';
                $dummyUser->email = 'lighthouse@example.com';

                if ($request->is('admin*')) {
                    // Jika mengakses rute admin, set role sebagai admin
                    $dummyUser->role = 'admin';
                } else {
                    // Jika mengakses rute biasa, set role sebagai user biasa
                    $dummyUser->role = 'user';
                }

                // Force authenticate statelessly for this request
                Auth::setUser($dummyUser);
            }
        }

        return $next($request);
    }
}
