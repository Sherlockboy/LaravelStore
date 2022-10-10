<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    public function index()
    {
        return view('checkout.billing');
    }
}
