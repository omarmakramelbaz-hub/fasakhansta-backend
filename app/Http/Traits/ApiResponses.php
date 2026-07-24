<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponses
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success', 
            'message' => $message, 
            'data' => $data
        ], $code);
    }

    protected function createdResponse($data, $message = 'ok', $code = 201)
    {
        return response()->json([
            'status'=> 'Success', 
            'message' => $message, 
            'data' => $data
        ], $code);
    }

    protected function unauthorizedResponse($data, $message = null, $code = 401)
    {
        return response()->json([
            'status'=> 'Error', 
            'message' => trans('main.there is an error in email or password'), 
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 500)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
    
    protected function msgResponse($message = null, $code = 400)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}