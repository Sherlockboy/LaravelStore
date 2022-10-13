<?php

namespace App\View\Components\Grid;

use Illuminate\View\Component;

class ProductGrid extends Component
{
    /**
     * Can be collection of cartItems of orderItems. $item->product must return App\Model\Product instance
     */
    public $items;

    /**
     * Grid type, can be either 'user' or 'admin'
     * @var string
     */
    public $type;

    /**
     * Number of grid columns, depends on grid type
     * @var int
     */
    public int $colNum;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $type = null)
    {
        $this->items = $items;
        $this->type = $type;
        $type == 'cart' ? $this->colNum = 6 : $this->colNum = 5;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.grid.product-grid');
    }
}
