<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tools\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{

    // 检测是否已经登录
    public function check_user_login(Request $request)
    {
        if (auth('tools')->parser()->setRequest($request)->hasToken()) {
            return $this->success_msg();
        } else {
            return $this->error_msg('Token Not Provided Or Other Error');
        }
    }

    public function login(Request $request)
    {
        $userinfo = $request->only(['username', 'password']);
        $token = auth('tools')->attempt($userinfo);
        if (!$token) {
            return $this->error_msg('用户名或密码错误');
        }

        $user_info = auth('tools')->user();  //用户信息

        return response()->json([
            'code' => 200,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \auth('tools')->factory()->getTTL() * 60,
            'user_info' => $user_info,
        ]);
    }

    public function logout()
    {
        Auth::guard('tools')->logout();
        return response()->json(['code' => 200, 'msg' => '退出成功']);
    }

}
