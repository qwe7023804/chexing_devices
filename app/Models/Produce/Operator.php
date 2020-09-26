<?php

namespace App\Models\Produce;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'produce_operators';
    protected $primaryKey = 'id';

    protected $fillable=['name', 'userphone', 'password', 'ctime', 'salt'];
}

