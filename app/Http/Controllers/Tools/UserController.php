<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Tools\User;
use App\Models\Tools\Menu;
use App\Models\Tools\Role;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $userlist = User::all();

        return $this->success_msg('Success', $userlist);
    }


    public function get_user_info()
    {
        $user_info = auth('tools')->user();
        return $this->success_msg('Success', $user_info);
    }

    public function me()
    {
        return response()->json(JWTAuth::parseToken()->touser());
    }

    public function get_permission_menus(Request $request)
    {
        $user_info = auth('tools')->user();
        $user_info = User::find($user_info['id']);


        if ($user_info['username'] === 'admin') {
            $new = Menu::where('parent_id')
                ->with('children')
                ->orderBy('order')
                ->get();

            return $this->success_msg('success', $new);
        }

        //获取角色id
        $roles_id = [];
        foreach ($user_info->roles()->get() as $v) {
            $roles_id[] = $v['id'];

        }

        //获取左侧栏ID
        $roles_info = Role::whereIn('id', $roles_id)->get();
        $menus_id = [];
        foreach ($roles_info as $v) {
            foreach ($v->menus as $vo) {
                if (!in_array($vo->id, $menus_id)) {
                    $menus_id[] = $vo->id;
                }
            }
        }

        $menus_model = Menu::whereIn('id', $menus_id)->orderBy('order')->get();
        $new = getChild($menus_model);

        return $this->success_msg('Success', $new);
    }

    public function store(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $nickname = $request->nickname;

        if (!preg_match('/^[a-z0-9_-]{6,20}$/', $username)) {
            return $this->error_msg('用户名格式错误！');
        }

        if (!preg_match('/^([a-zA-Z0-9\.\@\!\#\$\%\^\&\*\(\)]){6,20}$/', $password)) {
            return $this->error_msg('密码格式错误！');
        }

        if (empty($nickname)) {
            return $this->error_msg('请输入昵称');
        }

        $userinfo = User::where('username', $username)->first();

        if ($userinfo) {
            return $this->error_msg('此用户已存在！');
        }

        $hash_password = Hash::make($password);

        $user_info = [
            'username' => $username,
            'password' => $hash_password,
            'name' => $nickname,
            'created_at' => date('Y-m-d H:i:s')
        ];

        User::insert($user_info);
        return $this->success_msg('添加用户成功！');
    }

    public function changepassword(Request $request)
    {
        $user_id = $request->user_id;
        $newpassword = $request->password;

        $userinfo = User::where('id', $user_id)->first();

        if (empty($userinfo)) {
            return $this->error_msg("参数异常");
        }

        $password = Hash::make($newpassword);

        User::where('id', $user_id)->update(['password' => $password]);
        return $this->success_msg('修改成功！');
    }

    public function destroy(Request $request, $user_id)
    {
        if ((int)$user_id === 1) {
            return $this->error_msg('管理员禁止删除');
        }

        if (empty($user_id)) {
            return $this->error_msg('参数错误');
        }

        User::where('id', $user_id)->delete();

        return $this->success_msg('删除成功!');
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request, $user_id)
    {
        $userinfo = User::where('id', $user_id)->first();

        if (empty($userinfo)) {
            return $this->error_msg('用户不存在！');
        }

        return $this->success_msg('Success', $userinfo);
    }

    public function update(Request $request, $user_id)
    {
        $name = $request['name'];

        if (empty($name)) {
            return $this->error_msg('请输入昵称');
        }

        User::where('id', $user_id)->update(['name' => $name]);

        return $this->success_msg('修改成功！');
    }

}
