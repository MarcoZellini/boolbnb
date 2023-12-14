<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Apartment $apartment, Sponsorship $sponsorship)
    {
        /* dd([
            'sponsorship' => $sponsorship->id,
            'apartment' => $apartment->id
        ]); */

        $gateway =  new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);


        $client_token = $gateway->clientToken()->generate();

        return view('admin.apartments.payments.index', [
            'client_token' => $client_token,
            'sponsorship' => $sponsorship,
            'apartment' => $apartment
        ]);
    }

    public function process(Request $request, Apartment $apartment, Sponsorship $sponsorship)
    {
        $gateway =  new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $nonce = $request->input('payment_method_nonce');

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if (!$result->success) {
            //return error
        }

        /* return to_route('admin.apartments.sponsorships.store', [
            'sponsorship' => $sponsorship->id,
            'apartment' => $apartment->id
        ]); */

        return redirect()->route('admin.apartments.sponsorships.store', [
            'sponsorship' => $sponsorship->id,
            'apartment' => $apartment->id
        ]);
    }
}
