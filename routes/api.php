<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Account;
use Faker\Generator as Faker;
use App\Receipt;

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

Route::get('account/all', function(){
    return response()->json([
        Account::all()
    ],200);
});
Route::get('receipt/all', function(){
    return response()->json([
        Receipt::all()
    ],200);
});
Route::post('/send-sms', 'HomeController@sendSms');

Route::get('account/{bvn}', function ($bvn) {
    return response()->json(
        Account::where('bvn', $bvn)->get(),
        200
    );
});

Route::get('account/export', function(){
 
    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    // id: "HN4kXoGeNO",
    // name: "Orrin Boyle",
    // accountNumber: "3381439419",
    // bankName: "Guaranty Trust Bank",
    // bvn: "89382195332",
    // fingerPrint: "89382195332",
    // imageUrl: "http://www.larkin.com/eveniet-molestiae-quibusdam-nostrum-rem-amet-sit",
    // phoneNumber: "89382195332",
    // balance: 4832920,
    $accounts = Account::all();
    $columns = array('id', 'name', 'accountNumber', 'bankName', 'bvn', 'fingerPrint', 'imageUrl', 'phoneNumber', 'balance');

    $callback = function() use ($accounts, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($accounts as $account) {
            fputcsv($file, array($account->id, $account->name, $account->accountNumber, $account->bankName, $account->bvn, $account->imageUrl, $account->phoneNumber, $account->balance));
        }
        fclose($file);
    };
    return Response::stream($callback, 200, $headers);
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
