<?php

namespace App\View\Components\User;

use App\Models\Address;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressForm extends Component
{
    public ?Address $address;
    /**
     * @var mixed|string
     */
    public string $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action = null, Address $address = null)
    {
        $this->action = $action ?? route('address.store');
        $this->address = $address;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.user.address-form');
    }
}
