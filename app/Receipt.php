<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'id',
        'name',
        'phoneNumber',
        'amount',
        'shopName',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
