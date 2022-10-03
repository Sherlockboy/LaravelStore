<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        return view('product.index', compact('product'));
    }
}
