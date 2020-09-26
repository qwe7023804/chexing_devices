<?php

namespace App\Models\Produce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    protected $table = 'produce_admin_users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['name', 'password']; //可修改字段

    use Notifiable;


    //序列号隐藏字段
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role' => 'produce'];
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'produce_admin_role_users', 'user_id', 'role_id');
    }
}
