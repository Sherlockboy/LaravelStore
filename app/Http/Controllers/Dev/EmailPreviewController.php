<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Mail\NewOrder;
use App\Models\Order;

class EmailPreviewController extends Controller
{
    public function newOrder(Order $order)
    {
        return new NewOrder($order, false);
    }

    public function newOrderGuest(Order $order)
    {
        return new NewOrder($order, true);
    }
}
