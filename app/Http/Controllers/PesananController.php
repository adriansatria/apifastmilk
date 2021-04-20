<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Validator;

class PesananController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pesanan::all();

        if($pesanan) {
            return $this->SuccessResponse($pesanan, 200, 'Berhasil terhubung');
        }else{
            return $this->ErrorResponse('Gagal terhubung', 422);
        }
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
            'user_id' => 'required',
            'products_id' => 'required',
            'order_amount' => 'required',
            'order_ship_address' => 'required',
            'customer_phone_number' => 'required|numeric',
            'order_tracking_number' => 'required',
            'order_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);            
        }else{  
            $pesanan = Pesanan::create([
                'user_id' => $request->user_id,
                'products_id' => $request->products_id,
                'order_amount' => $request->order_amount,
                'order_ship_address' => $request->order_ship_address,
                'customer_phone_number' => $request->customer_phone_number,
                'order_tracking_number' => $request->order_tracking_number,
                'order_status' => $request->order_status,
            ]);

            if($pesanan){
                return $this->SuccessResponse($pesanan, 200, 'Data berhasil ditambah');
            }else{
                return $this->ErrorResponse('Data gagal ditambah', 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $pesanan = Pesanan::find($id);
            $pesanan->order_amount = $request->order_amount;
            $pesanan->order_ship_address = $request->order_ship_address;
            $pesanan->customer_phone_number = $request->customer_phone_number;
            $pesanan->order_tracking_number = $request->order_tracking_number;
            $pesanan->order_status = $request->order_status;
            $pesanan->save();

            if($pesanan){
                return $this->SuccessResponse($pesanan, 200, 'Data berhasil diubah');
            }else{
                return $this->ErrorResponse('Gagal mengubah data', 422);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesanan = \App\Models\Pesanan::findOrfail($id);
        $pesanan->delete();

        if($pesanan){
            return $this->SuccessResponse($pesanan, 200, 'Data berhasil dihapus');
        }else{
            return $this->ErrorResponse('Gagal menghapus data', 422);
        }
    }
}
