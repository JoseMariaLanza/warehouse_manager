<?php

use App\Http\Controllers\Api\v1\Account\AccountController as AccountControllerV1;
// use App\Http\Controllers\Api\v2\UserController as UserControllerV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::post('v1/register', [AccountControllerV1::class, 'register']);
// Route::post('v1/login', [AccountControllerV1::class, 'login']);

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::get('v1/user-profile', [AccountControllerV1::class, 'userProfile']);
//     Route::get('v1/logout', [AccountControllerV1::class, 'logout']);
//     // Route::get('v2/logout', [UserControllerV2::class, 'logout']);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['prefix' => 'shifts',  'middleware' => 'authorization'], function () {
//     Route::group(['prefix' => 'coordinator', 'middleware' => 'permissions'], function () {
//         Route::get('/', );
//     });
// });
