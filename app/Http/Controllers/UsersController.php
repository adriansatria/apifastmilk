<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::all();

        if($users){
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data'  => $users
            ], 200);
        }else{
            return response()->json([
              'status' => false
            ], 500);
        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_city' => 'required',
            'user_kode_pos' => 'required',
            'user_phone' => 'required',
            'user_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong'], 401);            
        }else{  
            
            $users = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_city' => $request->user_city,
                'user_kode_pos' => $request->user_kode_pos,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address
            ]);
            
            if($users){
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'data'  => $users
                ], 200);
            }else{
                return response()->json([
                'status' => false
                ], 500);
            }
        }
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function showWithForeignKey()
    {
        $users = \App\Models\User::with(['products'])->get();

        if($users){
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data'  => $users
            ], 200);
        }else{
            return response()->json([
              'status' => false
            ], 500);
        }

        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_city' => 'required',
            'user_kode_pos' => 'required',
            'user_phone' => 'required',
            'user_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong'], 401);            
        }else{  

            $users = \App\Models\User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->user_city = $request->user_city;
            $users->user_kode_pos = $request->user_kode_pos;
            $users->user_phone = $request->user_phone;
            $users->user_address = $request->user_address;
            $users->save();

            if($users){
                return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah',
                'Users' =>$users
                ], 200);
            }else{
                return response()->json([
                'status' => false
                ], 500);
            }
        }

        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = \App\Models\User::findOrfail($id);
        $users->delete();

        return response()->json([
           'success' => true,
           'message' => 'Data berhasil dihapus',
           'data' => $users
        ], 200);
    }
}
