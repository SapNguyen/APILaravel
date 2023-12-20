<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Http\Requests\StoreCinemaRequest;
use App\Http\Requests\UpdateCinemaRequest;
use App\Http\Resources\CinemaResource;
use App\Http\Resources\FilmResource;
use App\Http\Resources\ShowResource;
use App\Models\Film;
use App\Models\Show;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCinemaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCinemaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'showId' => 'required'
        ]);
        $show = Show::where('deleted',"0")
            ->where("idshow", $request->showId)->get();
        if(!isset($show[0])) return;

        $film = Film::where("deleted","0")
            ->where("idphim", $show[0]->idphim)->get();
        if(!isset($film[0])) return;

        $cinema = Cinema::where('deleted',"0")
            ->where('idphong',$show[0]->idphong)->get();
        if(count($cinema) > 0){
            $cinema[0]->showId = $request->showId;
            return  response()->json([
                "status" => "success",
                "cinema" => new CinemaResource($cinema[0]),
                "show" => new ShowResource($show[0]),
                "film" => new FilmResource($film[0])
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Phòng không tồn tại"
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCinemaRequest  $request
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCinemaRequest $request, Cinema $cinema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinema $cinema)
    {
        //
    }
}
