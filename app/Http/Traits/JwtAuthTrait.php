<?php

/**
 * References https://github.com/PHP-Open-Source-Saver/jwt-auth
 */

namespace App\Http\Traits;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait JwtAuthTrait
{
    protected function respondWithToken($token_params): JsonResponse
    {
        return response()->json([
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'access_token' => $token_params
        ]);
    }

    public function refreshToken()
    {
        $fresh_params = auth()->refresh();
        return $this->respondWithToken($fresh_params);
    }
}
