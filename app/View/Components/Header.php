<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Header extends Component
{
    public Collection $categories;
    public User|null $user;
    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->categories = Category::all();
        $this->user = auth()->user();
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.header');
    }
}
