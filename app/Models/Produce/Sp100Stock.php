<?php

namespace App\Models\Produce;

use Illuminate\Database\Eloquent\Model;

class Sp100Stock extends Model
{
    protected $table = 'produce_sp100_devices';
    protected $primaryKey = 'id';

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'user_id', 'id');
    }
}
