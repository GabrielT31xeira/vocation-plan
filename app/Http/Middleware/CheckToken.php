<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Lcobucci\JWT\Token\Parser;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $token = (new \Lcobucci\JWT\Token\Plain())->parse($token);
            $tokenId = $token->headers()->get('jti');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token parse failed: ' . $e->getMessage()], 401);
        }

        $tokenExists = DB::table('oauth_access_tokens')->where('id', $tokenId)->exists();

        if (!$tokenExists) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}
