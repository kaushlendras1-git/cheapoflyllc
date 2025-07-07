<?php

namespace App\Utils;

class JsonResponse 
{
    public static function successWithData($message = 'Success',$httpcode,$data,$code,$extra=[]){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code'=>$code,
            ...$extra
        ],$httpcode);
    }

    public static function success($message = 'Success',$httpcode,$code,$extra=[]){
        return response()->json([
            'message' => $message,
            'code'=>$code,
            ...$extra
        ],$httpcode);
    }
    public static function error($error,$httpcode,$code,$extra=[]){
        return response()->json([
            'error' => $error,
            'code'=>$code,
            ...$extra
        ],$httpcode);
    }
}
