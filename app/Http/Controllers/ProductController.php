<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        return view('product.index', compact('product'));
    }
}
