<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        $result = JWTToken::verifyToken($token);

        if ($result === 'Unauthorized') {
            return redirect('/');
        }

        // Ensure the authenticated user exists before checking user_type
        $user = Auth::user();
        if ($user && $user->user_type === 'admin') {
            return $next($request);
        }
         return redirect('/');


    }
}
