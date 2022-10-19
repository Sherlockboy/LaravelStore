<?php

namespace App\View\Components\Grid;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderGrid extends Component
{
    public $orders;

    /**
     * Grid type, can be either 'user' or 'admin'
     * @var string
     */
    public string $type;

    /**
     * Number of grid columns, depends on grid type
     * @var int
     */
    public int $colNum;

    /**
     * @return void
     */
    public function __construct($orders, string $type)
    {
        $this->orders = $orders;
        $this->type = $type;
        $type == 'admin' ? $this->colNum = 11 : $this->colNum = 8;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.grid.order-grid');
    }
}
