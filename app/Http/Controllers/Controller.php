<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

const SUCCESS_CODE = 200;
const SUCCESS_FAIL = 100;

protected function success($msg = 'ok', $data = [], $code = self::SUCCESS_CODE)
{
    return ['status' => $code, 'message' => $msg, 'data' => $data];
}

protected function data($data = [], $msg = 'ok', $code = self::SUCCESS_CODE)
{
    return ['status' => $code, 'message' => $msg, 'data' => $data];
}

protected function fail($msg = 'ok', $data = [], $code = self::SUCCESS_FAIL)
{
    return ['status' => $code, 'message' => $msg, 'data' => $data];
}
}
