<?php

namespace App\Http\Controllers;

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
        return view('product.create');
    }

    public function store()
    {
        $data = request()->validate(
          [
              'name' => ['required', 'string', 'unique:products'],
              'price' => ['required', 'numeric'],
              'description' => ['required', 'string'],
              'image' => ['required', 'image']
          ]);

        /** @var UploadedFile $image */
        $image = request('image');
        $imagePath = $image->store('product_images', 'public');

        $data['image'] = $imagePath;

        Product::create($data);


        dd($data);


    }
}
