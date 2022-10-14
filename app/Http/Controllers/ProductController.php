<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * @param Product $product
     * @return View
     */
    public function index(Product $product): View
    {
        $user = auth()->user();
        return view('product.index', compact('product', 'user'));
    }
}
