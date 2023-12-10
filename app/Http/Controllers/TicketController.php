<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Models\SeatStatus;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'userId' => 'required'
        ]);
        $tickets = Ticket::where('idtk',$request->userId)
            ->get();
        return new TicketCollection($tickets);
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
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $idghe = $request->idghe;
        $idtk = $request->idtk;
        $idshow = $request->idshow;
        $cost = $request->cost;

        $ticket = Ticket::where('idghe',$idghe)
            ->where('idshow',$idshow)
            ->where('idtk',$idtk)
            ->get();
        if(count($ticket) > 0) return;

        $ticket = new Ticket();
        $ticket->idtk=$idtk;
        $ticket->cost=$cost;
        $ticket->idshow=$idshow;
        $ticket->idghe=$idghe;
        $ticket->save();

        $seatStatus = SeatStatus::where('idghe', $idghe)
                ->where('idshow', $idshow)
                ->get();
        if(count($seatStatus) > 0){
            $seatStatus = $seatStatus[0];
        }else{
            $seatStatus = new SeatStatus();
        }
        
        $seatStatus->idshow = $idshow;
        $seatStatus->idghe = $idghe;
        $seatStatus->isSelected = 0;
        $seatStatus->isBooked = 1;
        $seatStatus->save();

        $ticket = Ticket::where('idghe',$idghe)
            ->where('idshow',$idshow)
            ->where('idtk',$idtk)
            ->get();

        return response()->json([
            'status' => 'success',
            "message" => "Đặt vé thành công",
            "user" => new TicketResource($ticket[0])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->validate([
            'userId' => 'required'
        ]);
        $ticket = Ticket::find($id);
        if($ticket){
            return  response()->json([
                "status" => "success",
                "ticket" => new TicketResource($ticket)
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Vé không tồn tại"
        ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
