<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App\Sp100Device;

class DeviceController extends BaseController
{
    public function sp100devices(Request $request)
    {
        $devsn = $request->devsn;
        $user_id = $request->user_id;

        if (empty($devsn)) {
            return $this->error_msg('缺少sn号');
        }

        if (empty($user_id)) {
            return $this->error_msg('缺少操作员');
        }

        $devinfo = Sp100Device::where('devsn', $devsn)->first();

        if ($devinfo) {
            return $this->error_msg('此设备已注册！');
        }

        $arrinsert = [
            'devsn' => $devsn,
            'user_id' => $user_id,
            'ctime' => date('Y-m-d H:i:s')
        ];
        $dev = Sp100Device::insertGetId($arrinsert);

        if ($dev) {
            return $this->success_msg('添加成功！', $dev);
        } else {
            return $this->error_msg('添加失败，重新添加！');
        }
    }

}
