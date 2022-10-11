<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $finalPrice = $user ? $user->cart->getFinalPrice() : 0;

        return view('checkout.index', compact('user', 'finalPrice'));
    }
}
