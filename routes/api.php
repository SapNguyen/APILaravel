<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\FilmController;


Route::group(['prefix' => 'users'], function () {
    Route::post('/{id}', [UserController::class, 'update']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
});
Route::group(['prefix' => 'promotions'], function () {
    Route::get('/findByCode', [PromotionController::class, 'findByCode']);
    Route::get('/{id}', [PromotionController::class, 'show']);
    Route::get('/', [PromotionController::class, 'index']);
});

Route::group(['prefix' => 'films'], function () {
    Route::get('/{id}', [FilmController::class, 'show']);
    Route::get('/', [FilmController::class, 'index']);
});