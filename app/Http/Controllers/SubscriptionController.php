<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $subscription = Subscription::create([
            'user_id' => auth()->id(),
            'subscription_type' => $request->subscription_type,
            'duration' => $request->duration,
            'total' => $request->total,
            'payment_status' => 'unpaid',
        ]);
    
        
        $PaymentKey = PayMobController::pay($subscription);
        return view('Payment.payment')->with(['token' => $PaymentKey]);
    }
   
}