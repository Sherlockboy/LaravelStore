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
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => ['required', 'unique:categories']
            ]);

        $category = Category::create($data);

        return redirect(route('admin.category.index'));
    }

    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();

        return response()->json(['name' => $categoryName]);
    }
}
