<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\JwtAuthTrait;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PrevilegeController extends Controller
{

    use JwtAuthTrait;
    public function __construct()
    {
        $this->middleware('is_auth', ['except' => ['login', 'register']]);
    }


    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);


        if ($validator->fails()) {
            return response()->json(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'msg' => $validator->messages()
                ]
            );
        }

        return $this->respondWithToken($token);
    }


    public function logout(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        try {
            auth()->logout();
            return response()->json([
                'code' => Response::HTTP_OK,
                'msg' => 'Successfully logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'msg' => 'Sorry, user cannot be logged out'
            ]);
        }
    }


    public function refresh()
    {
        return $this->refreshToken();
    }
}
