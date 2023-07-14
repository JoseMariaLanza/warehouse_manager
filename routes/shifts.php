<?php

use App\Http\Controllers\Api\v1\Shifts\ShiftController;
use App\Http\Middleware\AuthShiftRolesMiddleware;
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

Route::middleware(['auth:sanctum', 'jwt.decoder', 'plan.modules:Shifts', 'module.roles:Shifts'])->group(function () {
    Route::post('v1/', [ShiftController::class, 'index']);
    Route::get('v1/filter-shift', [ShiftController::class, 'getFiltered']);
    Route::post('v1/create-shift', [ShiftController::class, 'store']);
    Route::post('v1/update-shift', [ShiftController::class, 'update']);
});
