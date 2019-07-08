<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Account;
use Faker\Generator as Faker;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/fingerprint', 'HomeController@receiveFingerprint');

Route::post('/bank', 'HomeController@acceptBank');

Route::post('/send-sms', 'HomeController@sendSms');

Route::get('account/{bvn}', function ($bvn) {
    return response()->json(
        Account::where('bvn', $bvn)->get(),
        200
    );
});

Route::get('/account/create/{phone}/{num}', function (Faker $faker,$phone, $num) {
    if (gettype((int) $num) != "integer") {
        return response()->json([
            "error" => "number must be int"
        ], 422);
    }
    $name = $faker->name;
    for ($i = 0; $i < $num; $i++) {
        Account::create([
            'id' => str_random('10'),
            'name' => $name,
            'bankName' => $faker->name,
            'phoneNumber' => $phone,
            'fingerPrint' => $phone,
            'bvn' => $phone,
            'imageUrl' => $faker->url,
            'balance' => rand(999, 99999),
            'accountNumber' => rand(999999999, 9999999999),
        ]);
    }
});
