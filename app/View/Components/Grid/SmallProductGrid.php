<?php

namespace App\View\Components\Grid;

use App\Models\ProductRelatedItemsContainer;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SmallProductGrid extends Component
{
    public ProductRelatedItemsContainer $container;

    /**
     * Grid type, can be either 'cart', 'order' or 'wishlist'
     * @var string
     */
    public string $type;

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
    public function __construct(ProductRelatedItemsContainer $container, $type = null)
    {
        $this->container = $container;
        $this->type = $type;
        switch ($type) {
            case 'cart':
            {
                $this->colNum = 12;
                break;
            }

            case 'order': {
                $this->colNum = 10;
                break;
            }

            default:
                $this->colNum = 8;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.grid.small-product-grid');
    }
}
