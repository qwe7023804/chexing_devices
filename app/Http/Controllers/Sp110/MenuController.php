<?php

namespace App\Http\Controllers\Sp110;

use App\Models\Sp110\Role;
use App\Models\Sp110\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sp110\Menu;
use App\Models\Sp110\Permission;

class MenuController extends BaseController
{
    public function index(Request $request)
    {
        $list = Menu::where('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        return $this->success_msg('Success', $list);
    }

    public function store(Request $request)
    {
        $parent_id = last($request->parent_id);
        $menuname = $request->menuname;
        $icon = $request->icon;
        $perms = $request->perms;
        $uri = $request->uri;
        $level = count($request->parent_id) + 1;
        $time = date('Y-m-d H:i:s');
        if (!$parent_id or $parent_id == 0) {
            $parent_id = null;
            $level = 1;
        }

        $menuinfo = [
            'parent_id' => $parent_id,
            'level' => $level,
            'order' => 0,
            'title' => $menuname,
            'icon' => $icon,
            'uri' => $uri,
            'created_at' => $time
        ];

        $permission = [
            'parent_id' => $parent_id,
            'order' => 0,
            'title' => $menuname,
            'http_path' => $perms,
            'created_at' => $time
        ];

        Menu::insert($menuinfo);
        Permission::insert($permission);
        return $this->success_msg('添加成功！');
    }

    public function sortmenus(Request $request)
    {
        if (empty($request->parent_id)) {
            $menus = Menu::where('level', 1)
                ->orderBy('order')
                ->get(['id', 'uri', 'parent_id', 'level', 'order', 'title']);
        } else {
            $menus = Menu::where('parent_id', $request->parent_id)
                ->orderBy('order')
                ->get(['id', 'uri', 'parent_id', 'level', 'order', 'title']);
        }

        return $this->success_msg('Success', $menus);
    }

    public function edit(Request $request, $id)
    {
        $menuinfo = Menu::where('id', $id)->first();

        return $this->success_msg('Success', $menuinfo);
    }

    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return $this->error_msg('参数错误');
        }

        $menus = $request->only(['title', 'icon', 'uri']);

        Menu::where('id', $id)->update($menus);
        return $this->success_msg('修改成功！');
    }

    public function updatesortmenus(Request $request)
    {
        if (empty($request->menus_list)) {
            return $this->error_msg('参数错误！');
        }
        foreach ($request->menus_list as $value) {
            Menu::where('id', $value['id'])->update(['order' => $value['order']]);
        }
        return $this->success_msg();
    }

    public function destroy(Request $request, $id)
    {
        if (empty($id)) {
            return $this->error_msg('参数错误');
        }

        $menu_id = Menu::where('parent_id', $id)->first();

        if ($menu_id) {
            return $this->error_msg('请先删除下级菜单！');
        }

        Menu::where('id', $id)->delete();
        Permission::where('id', $id)->delete();
        return $this->success_msg('删除成功！');
    }
}