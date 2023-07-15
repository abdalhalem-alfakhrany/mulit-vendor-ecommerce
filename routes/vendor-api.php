<?php

use App\Http\Controllers\Api\Vendor\VendorOrdersController;
use App\Http\Controllers\Api\Vendor\VendorProductsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products',  VendorProductsController::class);
Route::apiResource('orders', VendorOrdersController::class)->only(['index', 'show', 'update']);
