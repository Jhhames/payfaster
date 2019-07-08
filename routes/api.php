<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Account;

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

Route::post('/bank','HomeController@acceptBank');

Route::post('/send-sms','HomeController@sendSms');

Route::get('account/{bvn}', function($bvn){
    return response()->json(
        Account::where('bvn',$bvn)->get()
        ,200);
});