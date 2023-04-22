<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function create()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        $payment_methods = $user->paymentMethods();
        $subscriptions = $user->subscriptions;

        $prices = [];

        foreach ($subscriptions as $subscription) {
            $price = \Stripe\Price::retrieve($subscription->stripe_price);
            $prices[] = '$' . number_format($price->unit_amount, 2);
        }

        return view('payments.index', [
            "user" => $user,
            "payment_methods" => $payment_methods,
            "prices" => $prices
        ]);
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $req_amount = $request->amount;
        $amount = str_replace(['$', ',', '.'], '', $req_amount);

        $user = Auth::user();
        $stripeCustomer = $user->createOrGetStripeCustomer();

        if ($request->payment_selection) {
            $payment_method = $request->payment_selection;
        } else {
            $payment_method =  $request->paymentMethodId;
        }

        $stripeCharge = $user->charge(
            $amount,
            $payment_method
        );

        return back();
    }
}
