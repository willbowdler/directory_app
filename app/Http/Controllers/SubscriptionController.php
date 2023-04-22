<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Price;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $req_amount = $request->amount;
        $amount = str_replace(['$', ',', '.'], '', $req_amount);

        $price = Price::create([
            'product_data' => [
                'name' => 'Custom Monthly Giving for ' . $req_amount,
                'type' => 'service',
            ],
            'unit_amount' => $amount,
            'currency' => 'usd',
            'recurring' => [
                'interval' => 'month',
            ],
        ]);

        Auth::user()->newSubscription(
            'default',
            $price->id
        )->create($request->paymentMethodId);

        return back();
    }
}
