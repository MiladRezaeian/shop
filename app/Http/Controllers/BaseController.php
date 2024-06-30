<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function successWithData($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function errorWithData($data, $errorCode = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => false,
            'data' => $data
        ], $errorCode);
    }

}
