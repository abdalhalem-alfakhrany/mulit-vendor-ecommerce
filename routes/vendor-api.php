<?php

use App\Http\Controllers\Api\Vendor\ProductsController;
use Illuminate\Support\Facades\Route;

Route::resource('Products',  ProductsController::class);
Route::prefix('orders')->group(function () {
    Route::get('/');
    Route::get('{id}');
    Route::post('{id}/reject');
    Route::post('{id}/accept');
    Route::post('{id}/done');
});
