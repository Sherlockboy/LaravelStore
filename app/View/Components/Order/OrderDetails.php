<?php

namespace App\View\Components\Order;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderDetails extends Component
{
    public Order $order;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.order.order-details');
    }
}
