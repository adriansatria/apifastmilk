<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController;
use App\Models\Products;
use Illuminate\Http\Request;
use Validator;

class ProductsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        if($products){
            return $this->SuccessResponse($products, 200, 'Berhasil');
        }else{
            return $this->ErrorResponse('Gagal menampilkan data', 422);
        }

        return response()->json($products);
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
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_weight' => 'required',
            'product_taste' => 'required',
            'description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);            
        }else{  

            $image = $request->file('product_image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);

            $products = Products::create([
                'categories_product_id' => $request->categories_product_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_weight' => $request->product_weight,
                'product_taste' => $request->product_taste,
                'description' => $request->description,
                'product_image' => $imagename,
                'product_stock' => $request->product_stock,
            ]);
            
            if($products){
                return $this->SuccessResponse($products, 200, 'Data berhasil ditambah');
            }else{
                return $this->ErrorResponse('Gagal menambah data', 422);
            }

        }

        return response()->json($products);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_weight' => 'required',
            'product_taste' => 'required',
            'description' => 'required',
            // 'product_image' => 'required',
            'product_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);            
        }else{  

            // if ($request->hasFile('product_image')) {
            //     $logo = $request->file('product_image');
            //     $fileName = date('Y') . $logo->getClientOriginalExtension();
            //     $request->company_logo->storeAs('product_image', $fileName, 'public');
            // }

            $products = Products::find($id);
            $products->product_name = $request->product_name;
            $products->product_price = $request->product_price;
            $products->product_weight = $request->product_weight;
            $products->product_taste = $request->product_taste;
            $products->description = $request->description;
            // $products->product_image = $request->product_image;
            $products->product_stock = $request->product_stock;
            $products->save();

            if($products){
                return $this->SuccessResponse($products, 200, 'Data berhasil diubah');
            }else{
                return $this->ErrorResponse('Gagal mengubah data', 422);
            }

        }

        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = \App\Models\Products::findOrfail($id);
        $products->delete();

        if($products){
            return $this->SuccessResponse($products, 200, 'Data berhasil dihapus');
        }else{
            return $this->ErrorResponse('Gagal menghapus data', 422);
        }

        return response()->json($products);
    }
}
