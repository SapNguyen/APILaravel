<?php

use App\Http\Controllers\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TicketController;
use App\Models\Film;
use App\Models\Show;
use Illuminate\Support\Carbon;

Route::group(['prefix' => 'users'], function () {
    Route::post('/{id}', [UserController::class, 'update']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/deleteUser/{id}', [UserController::class, 'destroy']);
});
Route::group(['prefix' => 'promotions'], function () {
    Route::get('/findByCode', [PromotionController::class, 'findByCode']);
    Route::get('/{id}', [PromotionController::class, 'show']);
    Route::get('/', [PromotionController::class, 'index']);
});

Route::group(['prefix' => 'films'], function () {
    Route::get('/{id}', [FilmController::class, 'show']);
    Route::get('/', [FilmController::class, 'index']);
    Route::get('/find/showing', [FilmController::class, 'findFilmShowing']);
    Route::get('/find/upComing', [FilmController::class, 'findFilmUpComing']);
    Route::get('/find/earlyShow', [FilmController::class, 'findFilmEarlyShow']);
    Route::get('/find/earlyShow/{id}', [FilmController::class, 'findFilmEarlyShowById']);
});

Route::group(['prefix' => 'cinema'], function () {
    Route::get('/{id}', [CinemaController::class, 'show']);
});

Route::group(['prefix' => 'seat'], function () {
    Route::get('/{id}', [SeatController::class, 'show']);
    Route::post('/{id}', [SeatController::class, 'update']);
});

Route::group(['prefix' => 'show'], function () {
    Route::get('/', [ShowController::class, 'index']);
    Route::get('/findByDate', [ShowController::class, 'findByDate']);
});

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/{id}', [TicketController::class, 'show']);
    Route::post('/', [TicketController::class, 'store']);
    Route::get('/', [TicketController::class, 'index']);
});

Route::group(['prefix' => 'test'], function () {
    Route::get('/', function(){
        //kiểm tra show có suát chiếu trùng nhau
        // $shows = Show::all();
        // foreach($shows as $show1){
        //     $date1 = $show1->start_time;
        //     $phong1 = $show1->idphong;
        //     foreach ($shows as $show2) {
        //         if($show1->idshow == $show2->idshow) continue;
        //         $date2 = $show2->start_time;
        //         $phong2 = $show2->idphong;
        //         if($date1 == $date2){
        //             return [
        //                 $show1,
        //                 $show2
        //             ];
        //         }
        //     }
        // }

        // 
        $film = '2023-12-14';
        return $film_show_time = [
            Carbon::now()->addHours(7)
            ->addDays(4)->format("Y-m-d H:i:s")
        ];
    });
});