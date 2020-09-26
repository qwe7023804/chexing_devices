<?php

namespace App\Models\Produce;

use Illuminate\Database\Eloquent\Model;

class RoleToUser extends Model
{
    protected $table = 'produce_admin_role_users';
    public $timestamps = true;
}
