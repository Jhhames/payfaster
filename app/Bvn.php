<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bvn extends Model
{
    public function account(){
        return $this->hasOne(Account::class);
    }

}
