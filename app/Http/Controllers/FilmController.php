<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Resources\FilmCollection;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Resources\ShowCollection;
use App\Models\Show;
use Carbon\Carbon;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        return new FilmCollection($films);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilmRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::find($id);
        if(!$film){
            return response()->json([
                'status' => 'fail',
                "message" => "Phim không tồn tại"
            ]);
        }

        $currentDate = Carbon::now()->toDateString();  
        $daysLater = Carbon::now()->addDays(4)->toDateString();
        $shows = Show::orderBy('start_time')
                ->where('idphim', $film->idphim)
                ->whereBetween('start_time', [$currentDate, $daysLater])
                ->get();

        if (count($shows) > 0){
            $film->shows = new ShowCollection($shows);
        }
        return response()->json([
            'status' => 'success',
            'film' => new FilmResource($film)
        ]);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
