<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PrevilegeController;
use App\Http\Controllers\API\ContentCRUD\TestingUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(

    function () {
        Route::post('/register', [PrevilegeController::class, 'register'])->name('register');
        Route::post('/login', [PrevilegeController::class, 'login'])->name('login');
        Route::post('/logout', [PrevilegeController::class, 'logout']);
        Route::post('/refresh', [PrevilegeController::class, 'refresh']);
    }
);

Route::prefix('user')->group(

    function () {
        Route::get('/', [TestingUserController::class, 'index']);
        Route::post('/getDetUser', [TestingUserController::class, 'getDetUser']);
    }
);
