<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKeyValue = $request->header('x-api-key');

        if (!$apiKeyValue) {
            return response()->json(['error' => 'API key is missing.'], 401);
        }

        $apiKey = ApiKey::where('key', $apiKeyValue)->first();

        if (!$apiKey) {
            return response()->json(['error' => 'Invalid API key.'], 401);
        }

        $user = User::find($apiKey->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 401);
        }

        $request->attributes->set('user', $user);

        return $next($request);
    }
}
