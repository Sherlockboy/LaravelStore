<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function index()
    {
        return view('checkout.shipping');
    }
}
