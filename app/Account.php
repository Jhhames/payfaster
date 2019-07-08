<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'id',
        'name',
        'bankName',
        'phoneNumber',
        'fingerPrint',
        'bvn',
        'imageUrl',
        'balance',
        'accountNumber',
    ];

    protected $hidden = ['created_at','updated_at'];

    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }

    public function bvn()
    {
        return $this->belongsTo(Bvn::class);
    }
}
