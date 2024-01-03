<?php

namespace App\Http\Controllers\API\ContentCRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\JwtAuthTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TestingUserController extends Controller
{
    use  JwtAuthTrait;
    public function __construct()
    {
        $this->middleware('is_auth');
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'msg'  => 'Hello World........ Welcome'
        ]);
    }
    public function getDetUser(): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'msg'  => true,
            'data' => auth()->user()
        ]);
    }
}
