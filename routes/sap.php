<?php

use App\Http\Controllers\SAPApi\ClientController;
use App\Http\Controllers\SAPApi\OrdersController;
use App\Http\Controllers\SAPApi\StockController;
use App\Http\Controllers\SAPApi\DeliveryController;
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
    Route::post('client/', [ClientController::class, 'login']);
    Route::post('orders/', [OrdersController::class, 'index']);
    Route::post('stock/', [StockController::class, 'index']);
    Route::post('delivery/', [DeliveryController::class, 'index']);
});
