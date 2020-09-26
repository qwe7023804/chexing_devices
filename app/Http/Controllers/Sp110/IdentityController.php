<?php

namespace App\Http\Controllers\Sp110;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sp110\Identity;

class IdentityController extends BaseController
{
    public function index(Request $request, Identity $identity)
    {
        $data = $identity::all();

        return $this->success_msg('Success', $data);
    }

    public function store(Request $request, Identity $identity)
    {
        $info = $request->name;

        if (empty($info)) {
            return $this->error_msg('身份信息不能为空');
        }

        $identity_info = ['name' => $info,
            'created_at' => date('Y-m-d H:i:s')];

        $identity::insert($identity_info);
        return $this->success_msg('添加身份成功！');
    }

    public function update(Request $request, $identity_id)
    {
        $name = $request->name;

        if (empty($name)) {
            return $this->error_msg('身份信息不能为空');
        }

        Identity::where('id', $identity_id)->update(['name' => $name]);

        return $this->success_msg('修改成功！');
    }

    public function destroy(Request $request, $identity_id)
    {

        if (empty($identity_id)) {
            return $this->error_msg('参数错误');
        }

        Identity::where('id', $identity_id)->delete();

        return $this->success_msg('删除成功!');
    }
}
