<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tools_admin_menus';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['parent_id', 'order', 'icon', 'uri', 'level'];

    public function child() {
        return $this->hasMany(get_class($this), 'parent_id');
    }

    public function children() {
        return $this->child()->with( 'children' )->orderBy('order');
    }
}
