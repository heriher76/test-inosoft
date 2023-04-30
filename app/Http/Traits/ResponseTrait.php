<?php

namespace App\Http\Traits;

trait ResponseTrait{
    public function responseSuccess($message, $code, $data = null){
        if($data == null){
            return response()->json([
                'message' => $message
            ], $code);
        }else{
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $code);
        }
    }

    public function responseError($message, $code){
        return response()->json([
            'message' => $message
        ], $code);
    }
}