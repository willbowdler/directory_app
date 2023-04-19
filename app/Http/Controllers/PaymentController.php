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
        return view('payments.index', [
            "user" => Auth::user(),
        ]);
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $req_amount = $request->amount;
        $amount = str_replace(['$', ',', '.'], '', $req_amount);

        $user = Auth::user();
        $stripeCustomer = $user->createOrGetStripeCustomer();

        $stripeCharge = $user->charge(
            $amount,
            $request->payment_method_id
        );

        return back();
    }

    public function subscription(Request $request)
    {
    }
}
