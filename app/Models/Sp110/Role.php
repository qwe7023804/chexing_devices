<?php

namespace App\Models\Sp110;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'sp110_admin_roles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ["name", "slug"];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'sp110_admin_role_menu', 'role_id', 'menu_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::clss, 'sp110_admin_role_permissions', 'role_id', 'permission_id');
    }

}
