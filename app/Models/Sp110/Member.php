<?php

namespace App\Models\Sp110;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';

    public function identity(){
        return $this->hasOne(Identity::class, 'id', 'identity_id');
    }
}

