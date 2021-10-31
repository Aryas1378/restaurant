<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function success($data, $code = 200)
    {
        return response()->json([
            'error' => 'false',
            'message' => 'operation successful',
            'data' => $data,
        ], $code);
    }

    public function error($message, $code = 401)
    {
        return response()->json([
            'error' => 'true',
            'message' => 'operation failed',
            'data' => $message
        ], $code);
    }
}
