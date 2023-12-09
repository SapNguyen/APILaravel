<?php

namespace App\Http\Controllers;

use App\Models\SeatStatus;
use App\Http\Requests\StoreSeatStatusRequest;
use App\Http\Requests\UpdateSeatStatusRequest;

class SeatStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreSeatStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeatStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function show(SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeatStatusRequest  $request
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeatStatusRequest $request, SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeatStatus $seatStatus)
    {
        //
    }
}
