<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Handles category-related actions done by admin user
 */
class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'unique:categories']
        ]);

        Category::create($data);

        return redirect(route('admin.category.index'));
    }

    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();

        return response()->json(['name' => $categoryName]);
    }
}
