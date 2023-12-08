<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;


Route::group(['namespace' => 'App\Http\Controllers'],function(){
    Route::apiResource('users',UserController::class);
    Route::apiResource('films',FilmController::class);
    Route::apiResource('promotions',PromotionController::class);
});

Route::get('promotions/findByCode/{code}', [App\Http\Controllers\PromotionController::class, 'findByCode']);
