<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $products = $category->products()->paginate(12);
        return view('category.index', compact('category', 'products'));
    }
}
