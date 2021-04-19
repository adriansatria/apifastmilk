<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController;
use App\Models\Sales;
use Illuminate\Http\Request;
use Validator;

class SalesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::all();

        if($sales){
            return $this->SuccessResponse($sales, 200, 'Berhasil terhubung');
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
        $validator = Validator::make($request->all(),[
            'sales_name' => 'required',
            'sales_email' => 'required|email|unique:sales',
            'password' => 'required',
            'sales_phone' => 'required|numeric',
            'sales_address' => 'required',
        ]);
    
            if($validator->fails()){
                return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);
            }else{
                $sales = Sales::create([
                    'sales_name' => $request->sales_name,
                    'sales_email' => $request->sales_email,
                    'password' => bcrypt($request->password),
                    'sales_phone' => $request->sales_phone,
                    'sales_address' => $request->sales_address,
                ]);
    
                if($sales){
                    return $this->SuccessResponse($sales, 200, 'Data berhasil ditambah');
                }else {
                    return $this->ErrorResponse('Data berhasil ditambah', 422);
                }
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sales_name' => 'required',
            'sales_email' => 'required|email',
            'password' => 'required',
            'sales_phone' => 'required',
            'sales_address' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Data tidak boleh kosong / Isi dengan benar'], 401);
        }else{
            $sales = Sales::find($id);
            $sales->sales_name = $request->sales_name;
            $sales->sales_email = $request->sales_email;
            $sales->password = bcrypt($request->password);
            $sales->sales_phone = $request->sales_phone;
            $sales->sales_address = $request->sales_address;
            $sales->save();

            if($sales){
                return $this->SuccessResponse($sales, 200, 'Data berhasil diubah');
            }else{
                return $this->ErrorResponse('Data gagal diubah', 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = Sales::findOrfail($id);
        $sales->delete();

        if($sales){
            return $this->SuccessResponse($sales, 200, 'Data berhasil dihapus');
        }else{
            return $this->ErrorResponse('Data gagal dihapus', 422);
        }
    }
}
