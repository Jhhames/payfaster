<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class HomeController extends Controller
{
    //7712ca540dc816d0d8b55fb88a298f6ab9a48206615d33df79bac2189e214891
    public function sendSms(Request $request)
    {
        $this->validate($request,[
            'phoneNumber'=> 'required',
            'amount' => 'required',
            'shopName' => 'required'
        ]);
        $number = $request->phoneNumber;
        $amount = $request->amount;
        $shop = $request->shopName;

        $username = 'hacktive-byte'; // use 'sandbox' for development in the test environment
        $apiKey   = '7712ca540dc816d0d8b55fb88a298f6ab9a48206615d33df79bac2189e214891'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $number,
            'message' => 'Payment successful. You just made a payment of NGN ' .$amount . ' to ' .$shop
        ]);

        return response([
            $result
        ]);
        
    }
}
