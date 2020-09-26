<?php

namespace App\Http\Controllers\Sp110;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sp110\Role;

class
RoleController extends BaseController
{
    public function index(Request $request)
    {
        $rolelist = Role::all();

        return $this->success_msg('Success', $rolelist);
    }

    public function store(Request $request)
    {
        if (empty($request->slug)) {
            return $this->error_msg('缺少参数');
        }

        $roles = Role::create(
            ['name' => $request->name,
                'slug' => $request->slug,
                'created_at' => date('Y-m-d H:i:s')]
        );

        if (empty($request->menus_list)) {
            return $this->error_msg('请选择目录！');
        }
        //添加中间表数值， 根据俩表id
        $roles->menus()->attach($request->menus_list);

        return $this->success_msg('添加成功！');
    }

    public function edit(Request $request, $role_id)
    {
        if (empty($role_id)) {
            return $this->error_msg('参数错误!');
        }

        if ((int)$role_id === 1) {
            return $this->error_msg('管理员禁止修改！');
        }

        $roleinfo = Role::where('id', $role_id)->first();


        $roles = Role::find($role_id)->menus()->select('id')->get();
        //makeHidden('pivot')
        $menus_id = [];
        foreach ($roles as $key => $value) {
            array_push($menus_id, $value->id);
        }

        $data['roleinfo'] = $roleinfo;
        $data['roles'] = $menus_id;

        return $this->success_msg('Success', $data);
    }

    public function update(Request $request, $role_id)
    {
        if ((int)$role_id === 1) {
            return $this->error_msg('管理员禁止修改！');
        }

        if (empty($role_id)) {
            return $this->error_msg('参数错误!');
        }

        if (empty($request->slug)) {
            return $this->error_msg('缺少参数');
        }


        $roleinfo = Role::where('id', $role_id)->first();

        $role = $request->only(['name']);

        Role::where('id', $role_id)->update($role);
        //任何不在给定数组中的id，将会中介表中被删掉（修改）
        $roleinfo->menus()->sync($request->menus_list);

        return $this->success_msg('修改成功！');
    }

    public function destroy(Request $request, $role_id)
    {
        if ((int)$role_id === 1) {
            return $this->error_msg('管理员角色禁止删除');
        }

        if (empty($role_id)) {
            return $this->error_msg('参数错误！');
        }

        $roleinfo = Role::where('id', $role_id)->first();

        Role::where('id', $role_id)->delete();

        $roleinfo->menus()->detach();

        return $this->success_msg('删除成功！');
    }

}
