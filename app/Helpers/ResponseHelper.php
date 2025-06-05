<?php

namespace App\Helpers;

class ResponseHelper{

    public static function created($message = 'Recurso creado con éxito', $extra = [])
    {
        return response()->json(array_merge([
            'error' => false,
            'message' => $message,
        ], $extra), 201);
    }

    public static function ok($message = 'Operacion exitosa', $extra = [])
    {
        return response()->json(array_merge([
            'error' => 'false',
            'message' => $message,
        ], $extra), 200);
    }

    public static function error($message = 'Ha ocurrido un error', $extra = [])
    {
        return response()->json(array_merge([
            'error' => 'true',
            'message' => $message,
        ], $extra), 400);
    }
}
