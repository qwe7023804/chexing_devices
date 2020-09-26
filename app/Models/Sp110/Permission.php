<?php

namespace App\Models\Sp110;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table= 'sp110_admin_permissions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ["name", "slug"];

    public function child() {
        return $this->hasMany(get_class($this), 'parent_id');
    }

    public function children() {
        return $this->child()->with( 'children' )->orderBy('order');
    }
}
