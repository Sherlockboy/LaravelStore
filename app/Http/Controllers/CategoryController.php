<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = Product::all();
        return view('category.index', compact('category', 'products'));
    }
}
