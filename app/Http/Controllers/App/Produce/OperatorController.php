<?php

namespace App\Http\Controllers\App\Produce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\App\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\App\ProdeceOperator;

class OperatorController extends BaseController
{
    public function login(Request $request)
    {
        $userphone = $request->userphone;
        $password = $request->password;

        $user = ProdeceOperator::where('userphone', $userphone)->first();

        if (empty($user)) {
            return $this->error_msg('用户不存在！');
        }

        if (Hash::check($password . $user['salt'], $user['password'])) {
            return $this->success_msg('登录成功！', ['user_id'=>$user['id']]);
        } else {
            return $this->error_msg('密码错误！');
        }

    }
}
