<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('category.index', compact('category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => ['required', 'unique:categories']
            ]);

        $category = Category::create($data);

        return redirect("/category/$category->id");
    }
}
