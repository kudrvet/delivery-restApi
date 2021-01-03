<?php

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
Route::get('buyers/{buyerID}/orders/delivery-cost',[\App\Http\Controllers\BuyerOrderController::class,'createUnconfirmedOrderWithDeliveryCost'])
->name('buyers.orders.');

Route::apiResource('sellers.goods',\App\Http\Controllers\SellerGoodController::class);

Route::apiresource('buyers.orders', \App\Http\Controllers\BuyerOrderController::class);

Route::apiResource('buyers',\App\Http\Controllers\BuyerController::class);

Route::apiResource('sellers',\App\Http\Controllers\SellerController::class);

Route::apiResource('couriers',\App\Http\Controllers\CourierController::class);
