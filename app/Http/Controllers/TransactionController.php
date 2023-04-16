<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class TransactionController extends Controller
{
    public function create()
    {
        return view('transactions.create');
    }

    public function charge()
    {


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => request('amount') * 100,
            "currency" => "usd",
            "customer" => Auth::id(),
            "description" => "This is a donation to such and such.",
        ]);
    }
}
