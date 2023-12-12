<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Http\Resources\PromotionCollection;
use App\Http\Resources\PromotionResource;
use Illuminate\Http\Request;


class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->page)){
            $promotions = Promotion::where('deleted',"0")->paginate(7);
        }
        else{
            $promotions = Promotion::where('deleted',"0")->get();
        }
        return new PromotionCollection($promotions);
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
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::where('deleted',"0")
            ->where('idkm', $id)->get();
        if(isset($promotion[0])){
            return  response()->json([
                "status" => "success",
                "promotion" => new PromotionResource($promotion[0])
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Khuyến mãi không tồn tại"
        ]);    
    }

    public function findByCode(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $code = $request->code;

        $promotion = Promotion::where('deleted',"0")
            ->where('code', $code)->get();
        if(isset($promotion[0])){
            return  response()->json([
                "status" => "success",
                "promotion" => new PromotionResource($promotion[0])
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Mã khuyến mãi không đúng"
        ]); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotionRequest  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
