<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::middleware('api')->group(function () {
// Protected routes
Route::get('/products', [ProductController::class, 'index']); // GET /api/products
Route::get('/products/{id}', [ProductController::class, 'show']); // GET /api/products/{id}
Route::post('/products', [ProductController::class, 'store']); // POST /api/products
Route::put('/products/{id}', [ProductController::class, 'update']); // PUT /api/products/{id}
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // DELETE /api/products/{id}

Route::post('/categories', [CategoryController::class, 'store']); // POST /api/categories
Route::get('/categories', [CategoryController::class, 'index']); // GET /api/categories
Route::get('/categories/{id}', [CategoryController::class, 'show']); // GET /api/categories/{id}
Route::put('/categories/{id}', [CategoryController::class, 'update']); // PUT /api/categories/{id}
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // DELETE /api/categories/{id}
Route::get('/categories/{id}/products/count', [CategoryController::class, 'countProductsInCategory']);

});
