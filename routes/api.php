<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('products', ProductController::class);
Route::resource('inventories', InventoryController::class);
