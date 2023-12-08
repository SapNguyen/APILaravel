<?php

use App\Http\Controllers\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SeatController;

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

Route::group(['prefix' => 'cinema'], function () {
    Route::get('/{id}', [CinemaController::class, 'show']);
});

Route::group(['prefix' => 'seat'], function () {
    Route::get('/{id}', [SeatController::class, 'show']);
    Route::post('/{id}', [SeatController::class, 'update']);
});