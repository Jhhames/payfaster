<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function receipt(){
        return $this->hasMany(Receipt::class);
    }

    public function bvn(){
        return $this->belongsTo(Bvn::class);
    }
}
