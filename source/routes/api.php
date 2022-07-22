<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderDiscountController;
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

Route::prefix('orders')->group(function(){
    Route::get('/', [OrderController::class, 'index']);

    Route::post('/', [OrderController::class, 'store']);

    Route::prefix('{order}')->group(function(){
        Route::delete('/', [OrderController::class, 'delete']);

        Route::get('discounts', [OrderDiscountController::class, 'index']);
    });
});
