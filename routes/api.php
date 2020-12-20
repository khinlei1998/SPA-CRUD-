<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('product',[ProductController::class,'index']);

// Route::post('prodcut',[ProductController::class,'store']);

// Route::get('product/{id}',[ProductController::class,'show']);

// Route::put('product/{id}',[ProductController::class,'update']);

Route::apiResource('product',ProductController::class);

