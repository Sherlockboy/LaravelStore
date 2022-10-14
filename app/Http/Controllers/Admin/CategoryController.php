<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

/**
 * Handles category-related actions done by admin user
 */
class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $data = request()->validate([
            'name' => ['required', 'unique:categories']
        ]);

        Category::create($data);

        return redirect(route('admin.category.index'));
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $categoryName = $category->name;
        $category->delete();

        return response()->json(['name' => $categoryName]);
    }
}
