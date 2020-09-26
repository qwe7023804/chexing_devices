<?php

namespace App\Models\Produce;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'produce_admin_roles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ["name", "slug"];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'produce_admin_role_menu', 'role_id', 'menu_id');
    }

}
