<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Routing\Middleware\ThrottleRequests;

class RequiredVerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'Missing API Key'], 401);
        }
        
        $user_count = DB::table('users')
            ->where('api_key', $apiKey)
            ->count();

        if ($user_count === 0) {
            return response()->json(['error' => 'Invalid API Key'], 401);
        }

        return $next($request);
    }

    
}
