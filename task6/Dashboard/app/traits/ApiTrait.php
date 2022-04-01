<?php
namespace App\traits;
trait ApiTrait {
    public static function successMessage(string $message = "success",int $statusCode = 200)
    {
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>(object)[],
            'errors'=>(object)[],
        ],$statusCode);
    }

    public static function errorMessage(array $errors , string $message = "error",int $statusCode = 422)
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'data'=>(object)[],
            'errors'=>(object)$errors,
        ],$statusCode);
    }

    public static function data(array $data , string $message = "",int $statusCode = 200)
    {
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>(object)$data,
            'errors'=>(object)[],
        ],$statusCode);
    }
}

