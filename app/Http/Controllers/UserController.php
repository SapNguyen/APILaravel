<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->page)){
            $users = User::where('deleted',"0")->paginate(7);
        }
        else{
            $users = User::where('deleted',"0")->get();
        }
        
        return new UserCollection($users);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:filter',
            'phone' => 'required',
            'password' => 'required'
        ]);

        // kiem tra email ton tai
        $get_email = User::where('email', '=', $request->email) 
            ->where('deleted',"0")
            -> get();
        if(isset($get_email[0]))
            return response()->json([
                'status' => 'fail',
                'message' => 'Email đã được sử dụng'
            ]);
        
        // kiem tra sdt ton tai
        $get_phone = User::where('deleted',"0")
            ->where('phone', '=', $request->phone)-> get();
        if(isset($get_phone[0]))
            return response()->json([
                'status' => 'fail',
                'message' => 'SĐT đã tồn tại, vui lòng chọn số khác'
            ]);

        //them moi user
        $create = new User;
        $create->email = $request->email;
        $create->phone = $request->phone;
        $create->name = $request->name;
        $create->password = $request->password;
        $create->save();

        $user = User::where('deleted',"0")
            ->where('email', '=', $request->email)->get();

        return response()->json([
            'status' => 'success',
            "message" => "Đăng ký thành công",
            "user" => new UserResource($user[0])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('idtk',$id)
            ->where('deleted',"0")->get();

        if(count($user) > 0){
            return  response()->json([
                "status" => "success",
                "user" => new UserResource($user[0])
            ]);
        }

        return response()->json([
            'status' => 'fail',
            "message" => "Tài khoản không tồn tại"
        ]);     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('idtk',$id)
            ->where('deleted',"0")->get();
            
        if(count($user) == 0){
            return response()->json([
                'status' => 'fail',
                "message" => "Tài khoản không tồn tại"
            ]);
        }
        $user = $user[0];
        // cap nhat user
        if(isset($request->phone)){
            if($request->phone != $user->phone){
                $check_phone = User::where('deleted',"0")
                    ->where('phone', '=', $request->phone)
                    -> get();
                if(isset($check_phone[0])){
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'SĐT đã tồn tại, vui lòng chọn số khác'
                    ]);
                }
            }
            $user->phone = $request->phone;
        }
        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->password)){
            $user->password = $request->password;
        }
        $user->save();

        return response()->json([
            'status' => 'success',
            "message" => "Cập nhật thành công",
            "user" => new UserResource($user)
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('idtk',$id)
            ->where('deleted',"0")->get();

        if(count($user) > 0){
            $user[0]->deleted = 1;
            $user[0]->save();
            return response()->json([
                'status' => 'success',
                "message" => "Đã xóa tài khoản"
            ]);
        }
        return response()->json([
            'status' => 'fail',
            "message" => "Tài khoản không tồn tại"
        ]);
    }
}
