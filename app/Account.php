<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Generator as Faker;

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

    protected $hidden = ['created_at', 'updated_at'];

    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }

    public function generateReceipt()
    {
        $faker = new Faker;
        $shops = ['BanWill','ACE Supermarket','Indulge'];
        $receipt = new Receipt();
        // $receipt->id = str_random('10');
        // $receipt->account_id = $this->id;
        $receipt->name = $this->name;
        $receipt->phoneNumber = $this->phoneNumber;
        $receipt->amount =rand(999, 9999);
        $receipt->shopName = array_random($shops);
        return $this->receipt()->save($receipt);
    }

    public function bvn()
    {
        return $this->belongsTo(Bvn::class);
    }
}
