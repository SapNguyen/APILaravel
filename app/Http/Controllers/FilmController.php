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
use App\Models\User;
use Carbon\Carbon;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->page)){
            $films = Film::where('deleted',"0")->paginate(7);
        }
        else{
            $films = Film::where('deleted',"0")->get();
        }
        return new FilmCollection($films);
    }
    public function findFilmShowing()
    {
        $today = Carbon::now()->addHours(7)->format("Y-m-d H:i:s");
        $nextDays = Carbon::now()->addHours(7)
            ->addDays(4)->format("Y-m-d H:i:s");
        $filmDBs = Film::where('deleted','0')
            ->get();
        if(!isset($filmDBs[0])) return [];
        $films = [];
        foreach ($filmDBs as $film) {
            if(Carbon::parse($film->release_date)->gt(Carbon::parse($today))) continue;
            $film_show_time = [
                $film->release_date." 00:00:00",
                $film->end_date." 23:59:59"
            ];
            $shows = Show::where('deleted','0')
                ->whereBetween('start_time',[$today, $nextDays])
                ->whereBetween('start_time', $film_show_time)
                ->get();
            if(!isset($shows[0])) continue;
            array_push($films, $film);
        }
        
        return new FilmCollection($films);
    }
    public function findFilmUpComing()
    {
        $today = Carbon::now()->addHours(7)
            ->addDays(1)->format("Y-m-d");
        $lastDayOfMonth = Carbon::now()
            ->endOfMonth()->format("Y-m-d");
        $films = Film::where('deleted',"0")
            ->whereBetween('release_date',[$today, $lastDayOfMonth])
            ->get();
        return new FilmCollection($films);
    }
    public function findFilmEarlyShow()
    {
        $today =  Carbon::now()->addHours(7)->format("Y-m-d H:i:s");
        $nextFourDays = Carbon::now()->addHours(7)
            ->addDays(2)->format("Y-m-d H:i:s");
        
        $filmDBs = Film::where('deleted','0')
            ->get();
        if(!isset($filmDBs[0])) return [];
        $films = [];
        foreach ($filmDBs as $film) {
            $early_time = [
                Carbon::parse($film->release_date)->subDays(2)->setTime(00,00,00)->format("Y-m-d H:i:s"),
                Carbon::parse($film->release_date)->subDays(1)->setTime(23,59,59)->format("Y-m-d H:i:s")
            ];
            $shows = Show::where('deleted','0')
                ->whereBetween('start_time',[$today, $nextFourDays])
                ->whereBetween('start_time', $early_time)
                ->get();

            if(!isset($shows[0])) continue;
            array_push($films, $film);
        }
        return new FilmCollection($films);
    }
    public function findFilmEarlyShowById($id)
    {
        $today =  Carbon::now()->addHours(7)->format("Y-m-d H:i:s");
        $nextFourDays = Carbon::now()->addHours(7)
            ->addDays(2)->format("Y-m-d H:i:s");
        
        $film = Film::where('deleted','0')
            ->where('idphim',$id)
            ->get();
        if(!isset($film[0])) return [
            'status' => 'fail',
            "message" => "Phim không tồn tại"
        ];
        $film = $film[0];
        $early_time = [
            Carbon::parse($film->release_date)->subDays(2)->setTime(00,00,00)->format("Y-m-d H:i:s"),
            Carbon::parse($film->release_date)->subDays(1)->setTime(23,59,59)->format("Y-m-d H:i:s")
        ];
        $shows = Show::where('deleted','0')
            ->whereBetween('start_time',[$today, $nextFourDays])
            ->whereBetween('start_time', $early_time)
            ->orderBy('start_time')->get();

        $film->shows = new ShowCollection($shows);
        if(!isset($shows[0])) return [
            'status' => 'fail',
            "message" => "Không có suất chiếu sớm"
        ];
        
        return new FilmResource($film);
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
        $film = new Film();
        $check = Film::where('name', $request->name)
            ->where('deleted',0)->get();
        if(count($check) > 0){
            return response()->json([
                'status' => "fail",
                'message' => "Phim đã tồn tại"
            ]);
        }
        $film->name = $request->name;
        $film->image = $request->image;
        if(isset($request->description)){
            $film->description = $request->description;
        }
        $film->release_date = $request->release_date;
        $film->end_date = $request->end_date;
        $film->runtime = $request->runtime;
        $film->age_validation = $request->age_validation;
        $film->genre = $request->genre;
        $film->director = $request->director;
        $film->actor = $request->actor;
        if(isset($request->language)){
            $film->language = $request->language;
        }
        $film->deleted = 0;
        $film->save();
        return response()->json([
            'status' => "success",
            'message' => "Thêm phim thành công"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::where('deleted',"0")
            ->where('idphim', $id)
            ->get();
        if(!isset($film[0])){
            return response()->json([
                'status' => 'fail',
                "message" => "Phim không tồn tại"
            ]);
        }
        $film = $film[0];
        $currentDate = Carbon::now()->addHours(7)
            ->format("Y-m-d H:i:s");  
        $daysLater = Carbon::now()->addHours(7)
            ->addDays(4)->setTime(23,59,59)
            ->format("Y-m-d H:i:s");
        $film_show_time = [
            $film->release_date." 00:00:00",
            $film->end_date." 23:59:59"
        ];
        $shows = Show::where('deleted',"0")
                ->orderBy('start_time')
                ->where('idphim', $film->idphim)
                ->whereBetween('start_time', $film_show_time)
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
