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
        $isLighthouse = false;
        
        if ($userAgent && (stripos($userAgent, 'Lighthouse') !== false || stripos($userAgent, 'PageSpeed') !== false || stripos($userAgent, 'Speed Insights') !== false)) {
            $isLighthouse = true;
        }

        // Inject dummy user ONLY if it's Lighthouse or specifically requested via ?lighthouse=1
        if (($isLighthouse || $request->has('lighthouse')) && !Auth::check()) {
            $dummyUser = new User();
            $dummyUser->id = 9999;
            $dummyUser->name = 'Lighthouse Tester';
            $dummyUser->email = 'lighthouse@example.com';
            $dummyUser->password = bcrypt('password'); 
            $dummyUser->role = 'admin'; 
            
            Auth::setUser($dummyUser);
        }
        
        return $next($request);
    }
}
