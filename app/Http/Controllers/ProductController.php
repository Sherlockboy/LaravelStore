<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        return view('product.index', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate(
          [
              'name' => ['required', 'string', 'unique:products'],
              'price' => ['required', 'numeric'],
              'description' => ['required', 'string'],
              'image' => ['required', 'image'],
              'category' => ['required']
          ]);

        /** @var UploadedFile $image */
        $image = request('image');
        $imagePath = $image->store('product_images', 'public');
        $data['image'] = $imagePath;

        $product = Product::create($data);
        $product->categories()->toggle($data['category']);

        return redirect("product/$product->id");
    }
}
