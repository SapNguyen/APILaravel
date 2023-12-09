<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Http\Requests\StoreSeatRequest;
use App\Http\Requests\UpdateSeatRequest;
use App\Http\Resources\SeatResource;
use App\Models\SeatStatus;
use Illuminate\Http\Request;

class SeatController extends Controller
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
     * @param  \App\Http\Requests\StoreSeatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->validate([
            'id_show' => 'required'
        ]);
        $seat = Seat::find($id);
        if($seat){
            $seat->id_show = $request->id_show;
            return  response()->json([
                "status" => "success",
                "seat" => new SeatResource($seat)
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Ghế không tồn tại"
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat $seat)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeatRequest  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeatRequest $request, $id)
    {
        $seat = Seat::find($id);
        if(!isset($seat)){
            return response()->json([
                'status' => 'fail',
                "message" => "Ghế không tồn tại"
            ]);
        }
        $seatStatus = SeatStatus::where('idghe', $id)
                ->where('idshow', $request->id_show)
                ->get();
        if(count($seatStatus) > 0){
            $seatStatus = $seatStatus[0];
        }else{
            $seatStatus = new SeatStatus();
        }
        
        $seatStatus->isSelected = $request->isSelected;
        $seatStatus->save();

        $seat->id_show = $request->id_show;
        return response()->json([
            'status' => 'success',
            "message" => "Cập nhật thành công",
            "seat" => new SeatResource($seat)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
