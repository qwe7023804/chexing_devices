<?php

namespace App\Http\Controllers\Produce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        // 这里额外注意了：官方文档样例中只除外了『login』
        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
        // 不过刷新一次作废
        // 另外关于上面的中间件，官方文档写的是『auth:api』
        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
        //$this->middleware('auth:sp110', ['except' => ['login']]);
        $this->middleware('produce_refresh:produce', ['except' => ['login', 'check_user_login']]);
    }

    protected function success_msg($msg = 'Success', $data = [])
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
