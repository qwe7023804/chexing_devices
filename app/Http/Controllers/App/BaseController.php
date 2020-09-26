<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {

    }

    protected function success_msg($msg = 'Success', $data)
    {
        return ['code' => 200, 'msg' => $msg, 'data' => $data];
    }

    protected function error_msg($msg = 'Error', $data = [])
    {
        return ['code' => 500, 'msg' => $msg, 'data' => $data];
    }

    protected function auto_msg($code, $msg = 'Success', $data = [])
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}
