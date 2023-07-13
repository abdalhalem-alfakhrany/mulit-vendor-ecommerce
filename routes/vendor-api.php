<?php

use App\Http\Controllers\Api\Vendor\OrdersController;
use App\Http\Controllers\Api\Vendor\ProductsController;
use Illuminate\Support\Facades\Route;

Route::resource('products',  ProductsController::class);
Route::resource('orders', OrdersController::class)->only(['index', 'show', 'update']);
