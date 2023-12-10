<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;
use App\Http\Resources\FilmCollection;
use App\Http\Resources\FilmResource;
use App\Http\Resources\ShowCollection;
use App\Http\Resources\ShowResource;
use App\Models\Film;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ShowController extends Controller
{
    private $range_date = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $shows = Show::all();
        // $format = 'Y-m-d H:i:s';
        // foreach ($shows as $show) {
        //     foreach ($shows as $show2) {
        //         if ($show->idshow == $show2->idshow) continue;
        //         if ($show->idphong != $show2->idphong) continue;
        //         if ($show->idphim != $show2->idphim) continue;
        //         $date1 = DateTime::createFromFormat($format, $show->start_time);
        //         $date2 = DateTime::createFromFormat($format, $show2->start_time);
                
        //         if ($date1->format('Y-m-d H:i') != $date2->format('Y-m-d H:i')) break;
        //         return response()->json([
        //             'show1' => new ShowResource($show),
        //             'show2' => new ShowResource($show2)
        //         ]);
        //     }
        // }

        $nextDays = Carbon::now()->addDays($this->range_date);
        $rangeDate = [
            strval(Carbon::now()),
            strval(explode(" ",$nextDays)[0]).' 23:59:59'
        ];

        $filmIds = Show::where('deleted',0)
            ->whereBetween('start_time', $rangeDate)
            ->pluck('idphim')->unique()->values();
        
        if(count($filmIds) == 0){
            return response()->json([
                'status' => 'fail',
                'message' => "Không có xuất chiếu tương ứng"
            ]);
        }    
        $films = [];
        for($i=0; $i < count($filmIds); $i++){
            $film = Film::where('deleted',0)
                ->where('idphim', $filmIds[$i])->get();
            if(count($film) == 0) continue;

            $shows = Show::where('deleted',0)
                ->whereBetween('start_time', $rangeDate )
                ->where('idphim', $film->idphim)
                ->orderBy('start_time')
                ->get();
            $film->shows = new ShowCollection($shows);
            $films[$i] = $film[0];
        }
        if (count($films) > 0){
            return response()->json([
                'status' => 'success',  
                'films' => new FilmCollection($films)
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => "Không có xuất chiếu tương ứng"
        ]);
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
     * @param  \App\Http\Requests\StoreShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShowRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    function isValidDateFormat($date, $format)
    {
        $pattern = '/^\d{4}-\d{2}-\d{2}$/';
    
        switch ($format) {
            case 'Y-m-d':
                $pattern = '/^\d{4}-\d{1,2}-\d{1,2}$/';
                break;
            case 'Y/m/d':
                $pattern = '/^\d{4}\/\d{1,2}\/\d{1,2}$/';
                break;
            
            default:
                return false;
        }

        return preg_match($pattern, $date) === 1;
    }
    function parseStringToDateTime($dateString)
    {
        $timestamp = strtotime($dateString);

        if ($timestamp === false) {
            // Parsing failed
            return null;
        }
        return date('Y-m-d H:i:s', $timestamp);
    }
    public function findByDate(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ]); 

        $formats = [
            'Y-m-d',
            'Y/m/d'
        ];
        $isFormatValid = false;
        foreach ($formats as $format) {
            $isFormatValid = $this->isValidDateFormat($request->date, $format);
            if ($isFormatValid) break;
        }
        if(!$isFormatValid){
            return response()->json([
                'status' => 'fail',
                'message' => 'Ngày không hợp lệ'
            ]);
        }
        $date = $this->parseStringToDateTime($request->date);
        if($date == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'Ngày không hợp lệ'
            ]);
        }
        
        $rangeDate = [
            strval(explode(" ",$date)[0]).' 00:00:00',
            strval(explode(" ",$date)[0]).' 23:59:59'
        ];

        $filmIds = Show::where('deleted',0)
            ->whereBetween('start_time', $rangeDate )
            ->pluck('idphim')->unique()->values();
        if(count($filmIds) == 0){
            return response()->json([
                'status' => 'fail',
                'message' => "Không có xuất chiếu tương ứng"
            ]);
        }
        $films = [];
        for($i=0; $i < count($filmIds); $i++){
            $film = Film::where('deleted',0)
                ->where('idphim',$filmIds[$i])->get();
            if(count($film) == 0) continue;

            $shows = Show::where('deleted',0)
                ->whereBetween('start_time', $rangeDate )
                ->where('idphim', $film->idphim)
                ->orderBy('start_time')
                ->get();
            $film->shows = new ShowCollection($shows);
            $films[$i] = $film[0];
        }
        if (count($films) > 0){
            return response()->json([
                'status' => 'success',
                'films' => new FilmCollection($films)
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => "Không có xuất chiếu tương ứng"
        ]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShowRequest  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShowRequest $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        //
    }
}
