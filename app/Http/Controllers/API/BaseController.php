<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    public function SuccessResponse($result, $code = 200, $message)
    {
        $response = [
            'status code' => $code,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response, $code);
    }

    public function ErrorResponse($error, $code = 422, $errordetails = [])
    {
        $response = [
            'code' => $code,
            'error' => $error
        ];

        if(!empty($errordetails)){
            $response['errorDetails'] = $errordetails;
        }

        return response()->json($response, $code);
    }
}
