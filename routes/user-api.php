<?php

use App\Http\Controllers\Api\User\ShoppingCartController;
use App\Http\Controllers\Api\User\ShoppingCartProductsController;
use App\Http\Controllers\Api\User\ShoppingController;
use Illuminate\Support\Facades\Route;

Route::prefix('offers')->group(function () {
    Route::get('product/{id}', [ShoppingController::class, 'get_offers_product']);
    Route::get('vendor/{id}', [ShoppingController::class, 'get_offers_vendor']);
    Route::get('tag/{id}', [ShoppingController::class, 'get_offers_tag']);
});

Route::get('products_preferred', [ShoppingController::class, 'get_products_preferred']);

Route::get('product/{id}', [ShoppingController::class, 'get_product']);

Route::prefix('vendors/{id}')->group(function () {
    Route::get('/', [ShoppingController::class, 'vendor_show']);
    Route::get('products', [ShoppingController::class, 'vendor_products']);
});

Route::prefix('carts')->group(function () {
    Route::resource('/', ShoppingCartController::class);
    Route::resource('{id}/products', ShoppingCartProductsController::class);
});

// // purchasing
// Route::prefix('purchases')->group(function () {
//     Route::post('{id}', function () {
//         dd('purchase a shopping cart');
//     });
//     Route::get('/', function () {
//         dd('get list of all purchases');
//     });
// });
