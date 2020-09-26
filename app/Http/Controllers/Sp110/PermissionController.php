<?php

namespace App\Http\Controllers\Sp110;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sp110\Permission;

class PermissionController extends BaseController
{
    public function index(Request $request)
    {
        $permissionlist = Permission::where('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        return $this->success_msg('Success', $permissionlist);
    }
}
