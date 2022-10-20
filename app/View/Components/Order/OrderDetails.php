<?php

namespace App\View\Components\Order;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderDetails extends Component
{
    public Order $order;

    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Order $order, string $type = 'user')
    {
        $this->order = $order;
        $this->type = $type;
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
