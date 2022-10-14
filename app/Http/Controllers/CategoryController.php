<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * @param Category $category
     * @return View
     */
    public function index(Category $category): View
    {
        $products = $category->products()->paginate(12);
        return view('category.index', compact('category', 'products'));
    }
}
