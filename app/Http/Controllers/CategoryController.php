<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products;
        return view('category.index', compact('category'));
    }
}
