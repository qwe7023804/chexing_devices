<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\MemberRequest;
use App\Models\App\ProdeceOperator;

class MemberController extends BaseController
{
    public function login(MemberRequest $request, ProdeceOperator $member)
    {
        $userphone = $request->userphone;
        $password = $request->password;

//        $user = $member::where('userphone', $userphone)->first();
//
//        if (empty($user)) {
//            return $this->error_msg('用户不存在！');
//        }
        return $this->success_msg($userphone, $userphone);
//        $password =

    }
}
