<?php

use App\Http\Controllers\Api\User\UserCartsController;
use App\Http\Controllers\Api\User\UserOffersController;
use App\Http\Controllers\Api\User\UserProductsController;
use App\Http\Controllers\Api\User\UserVendorsController;
use Illuminate\Support\Facades\Route;


Route::apiResource('carts', UserCartsController::class);
Route::apiResource('products', UserProductsController::class);
Route::apiResource('vendors', UserVendorsController::class);
