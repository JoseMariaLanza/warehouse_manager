<?php

use App\Http\Controllers\Api\v1\Account\AccountController as AccountControllerV1;
use App\Http\Middleware\CustomUserAuthorization;
use App\Http\Middleware\JWTAuth;
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

Route::middleware(['jwt.decoder'])->group(function () {
    Route::post('v1/register', [AccountControllerV1::class, 'register']);
    Route::post('v1/login', [AccountControllerV1::class, 'login']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('v1/user-profile', [AccountControllerV1::class, 'userProfile']);
    Route::get('v1/logout', [AccountControllerV1::class, 'logout']);
});
