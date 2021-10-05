<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));


        if(!$token) {
            return response()->json([
                'error' => 'Token missing.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Token expired.'
            ], 400);
        } catch (Exception $e) {
            logger($e);
            return response()->json([
                'error' => 'An error happened while decoding token.'
            ], 400);
        }

        $user = User::find($credentials->sub);
        Auth::login($user);
        // $request->merge([
        //     'auth' => $user
        // ]);

        return $next($request);
    }
}
