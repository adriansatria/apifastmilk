<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Validator;
use Auth;

class AuthSalesController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if($validator->fails()){
            return $this->ErrorResponse('Login gagal', 422);
        }

        if(Auth::attempt(['sales_email' => $request->sales_email, 'password' => $request->password])){
            $sales = Auth::user();
            $response = [
                'token' => $sales->createToken('MySalesToken')->accessToken,
                'sales_name' => $sales->sales_name
            ];
            return $this->SuccessResponse($response, 200, 'Login berhasil');
        }else{
            return $this->ErrorResponse('Login gagal', 422);
        }
    }
}
