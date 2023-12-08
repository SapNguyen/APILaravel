<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;


Route::get('promotions/findByCode/{code}', [PromotionController::class, 'findByCode']);
Route::group(['prefix' => 'users'], function () {
    Route::post('users/{id}', [UserController::class, 'update']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users', [UserController::class, 'index']);
});