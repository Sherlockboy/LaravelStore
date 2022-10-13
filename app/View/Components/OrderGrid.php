<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderGrid extends Component
{
    /**
     * Grid type, can be either 'user' or 'admin'
     * @var string
     */
    public string $type;

    /**
     * @return void
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        if ($this->type == 'user') {
            $orders = auth()->user()->orders;
            $colNum = 8;
        } else {
            $orders = Order::all();
            $colNum = 10;
        }

        return view('components.order-grid', compact('orders', 'colNum'));
    }
}
