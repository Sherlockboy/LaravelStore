<?php

namespace App\View\Components\Grid;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BigProductGrid extends Component
{
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.grid.big-product-grid');
    }
}
