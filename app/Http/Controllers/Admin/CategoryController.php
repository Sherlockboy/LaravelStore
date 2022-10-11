<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
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
