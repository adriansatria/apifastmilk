<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = \App\Models\ProductsCategories::all();

        if($category){
            return response()->json([
                'status' => true,
                'message' => 'Berhasil terkoneksi',
                'List categories' => $category
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal terhubung',
            ], 500);
        }

        return response()->json($category);
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
            'categories_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);            
        }else{  
            $category = \App\Models\ProductsCategories::create([
                'categories_product_id' => $request->categories_product_id,
                'categories_name' => $request->categories_name,
            ]);

            if($category){
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil ditambah',
                    'data'  => $category
                ], 200);
            }else{
                return response()->json([
                'status' => false
                ], 500);
            }
        }

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsCategories $category)
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
            'categories_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> 'Data tidak boleh kosong / Isi dengan benar'], 401);            
        }else{  
            
            $category = \App\Models\ProductsCategories::find($id);
            $category->categories_name = $request->categories_name;
            $category->save();

            if($category){
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diubah',
                    'data'  => $category
                ], 200);
            }else{
                return response()->json([
                'status' => false
                ], 500);
            }
        }

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Models\ProductsCategories::findOrfail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $category
         ], 200);
    }
}
