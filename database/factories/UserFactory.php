<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Bvn;
use App\Receipt;
use App\Account;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Account::class, function (Faker $faker) {
    $phone = rand(999999999,99999999999);
    return [
        'id' => str_random('10'),
        'name' => $faker->name,
        'bankName' => $faker->name,
        'phoneNumber' => $phone,
        'fingerPrint' => $phone,
        'bvn' => $phone,
        'imageUrl' => $faker->url,
        'balance' => rand(999,9999999),
        'accountNumber' => rand(999999999,9999999999),

    ];
});
$factory->define(Receipt::class, function (Faker $faker) {
    $phone = rand(999999999,99999999999);
    return [
        'id' => str_random('10'),
        'name' => $faker->name,
        'phoneNumber' => $phone,
        'amount' => rand(999,9999),
        'shopName' => $faker->company

    ];
});
