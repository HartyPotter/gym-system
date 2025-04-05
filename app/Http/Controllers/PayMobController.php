<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IslamAlsayed\PayMob\PayMob;
use App\Models\Subscription;

class PayMobController extends Controller
{
    public static function pay($subscription)
{
    $auth = PayMob::AuthenticationRequest();
    //dd(env('PAYMOB_USERNAME') ,env('PAYMOB_PASSWORD'));
    $fullName = $subscription->user->fullname; 
    $names = explode(' ', $fullName, 2);
    $firstName = $names[0] ?? '';
    $lastName = $names[1] ?? '';  

    $paymobOrder = PayMob::OrderRegistrationAPI([
        'auth_token' => $auth->token,
        'amount_cents' => $subscription->total * 100,
        'currency' => 'EGP',
        'delivery_needed' => false,
        'merchant_order_id' => $subscription->id,
        'items' => [],
    ]);

    $paymentKey = PayMob::PaymentKeyRequest([
        'auth_token' => $auth->token,
        'amount_cents' => $subscription->total * 100,
        'currency' => 'EGP',
        'order_id' => $paymobOrder->id,
        'billing_data' => [
            "apartment" => "803",
            'email' => $subscription->user->email,
            "floor" => "42",
            'first_name' => $firstName, 
            "street" => "Ethan Land",
            "building" => "8028",
            'phone_number' => $subscription->user->phone,
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => $lastName,
            "state" => "Utah"
        ],
    ]);

    return $paymentKey->token;
}


    public function checkoutProcessed(Request $request)
    {
        $requestHmac = $request->hmac;
        $calcHmac = PayMob::calcHMAC($request);

        if ($requestHmac == $calcHmac) {
            $subscriptionId = $request->obj['order']['merchant_order_id'];
            $amountCents = $request->obj['amount_cents'];
            $transactionId = $request->obj['id'];

            $subscription = Subscription::findOrFail($subscriptionId);

            if ($request->obj['success'] && ($subscription->total * 100) == $amountCents) {
                $subscription->update([
                    'payment_status' => 'paid',
                    'transaction_id' => $transactionId,
                ]);
            } else {
                $subscription->update(['payment_status' => 'unpaid']);
            }
        }
    }
}