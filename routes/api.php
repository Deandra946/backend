<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('v1/post')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/', [PostController::class,'store']);
    Route::get('/{id}', [PostController::class,'show']);
    Route::post('/like/{postId}', [LikeController::class,'store']);
    Route::delete('/unlike/{postId}', [LikeController::class,'unlike']);
});
