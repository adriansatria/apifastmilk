<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Hash;
use \App\Models\User;

class AuthUserController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string' ,'email'],
            'password' => ['required', 'string']
        ]);
        
        if($validator->fails()){
            return $this->ErrorResponse('Login gagal', 422, $validator->errors());
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $response = [
                'token' => $user->createToken('MyApp')->accessToken,
                'name' => $user->name,
                'products' => $user->products
            ];

            return $this->SuccessResponse($response, 200, 'Login berhasil');
        } else {
            return $this->ErrorResponse('Password atau email salah', 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string' ,'email', 'unique:users'],
            'password' => ['required', 'string'],
            'user_city' => ['required', 'string'],
            'user_kode_pos' => ['required'],
            'user_phone' => ['required',],
            'user_address' => ['required', 'string', 'max:255'], 
        ]);
        
        if($validator->fails()){
            return $this->ErrorResponse('Login gagal', 422, $validator->errors());
        }

        $params = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_city' => $request->user_city,
            'user_kode_pos' => $request->user_kode_pos,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address
        ];
        
        if($user = User::create($params))
        {
            $token = $user->createToken('MyApp')->accessToken;

            $response = [
                'token' => $token,
                'user' => $user
            ];
        }
        return $this->SuccessResponse($response, 200, 'Registrasi berhasil');
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->token()->revoke();
        if($logout){
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }
}
