<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Models\Seat;
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
        $tickets = Ticket::where('deleted',"0")
            ->where('idtk',$request->userId)
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
        $idghes = explode(",", $request->idghe);
        $idtk = $request->idtk;
        $idshow = $request->idshow;
        $cost = $request->cost;
        $seatName = [];
        foreach ($idghes as $seatId){
            $seat = Seat::find($seatId);
            array_push($seatName, $seat->row . $seat->column);
        }
        $seatName = implode(",", $seatName);

        $ticket = Ticket::where('deleted',"0")
            ->where('idshow',$idshow)
            ->where('idtk',$idtk)
            ->get();
        if(count($ticket) > 0 ) {
            if($ticket[0]->seat == $seatName){
                return response()->json([
                    "status" => "fail",
                    "message" => "Ghế đã được đặt"
                ]);
            }
        }

        $ticket = new Ticket();
        $ticket->idtk=$idtk;
        $ticket->cost=$cost;
        $ticket->idshow=$idshow;
        $ticket->seat=$seatName;
        $ticket->idghe=$idghes[0];
        $ticket->save();

        foreach ($idghes as $seatId){
            $seatStatus = SeatStatus::where('idghe', $seatId)
                ->where('idshow', $idshow)
                ->get();
            if(count($seatStatus) > 0){
                $seatStatus = $seatStatus[0];
            }else{
                $seatStatus = new SeatStatus();
            }
            
            $seatStatus->idshow = $idshow;
            $seatStatus->idghe = $seatId;
            $seatStatus->isSelected = 0;
            $seatStatus->isBooked = 1;
            $seatStatus->save();
        }

        $ticket = Ticket::where('deleted',"0")
            ->where('seat',$seatName)
            ->where('idshow',$idshow)
            ->where('idtk',$idtk)
            ->get();

        if(count($ticket) == 0) return;
        return response()->json([
            'status' => 'success',
            "message" => "Đặt vé thành công",
            "ticket" => new TicketResource($ticket[0])
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
        $ticket = Ticket::where('deleted',"0")
            ->where('idve', $id)->get();
        if(count($ticket) > 0){
            return  response()->json([
                "status" => "success",
                "ticket" => new TicketResource($ticket[0])
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
