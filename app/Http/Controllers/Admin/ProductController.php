<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

/**
 * Handles product-related actions done by admin user
 */
class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $data = request()->validate(
            [
                'name' => ['required', 'string', 'unique:products'],
                'price' => ['required', 'numeric'],
                'description' => ['required', 'string'],
                'image' => ['required', 'image'],
                'category' => ['required']
            ]);

        $data['image'] = $this->resizeImageAndGetPath(request('image'));

        /** @var Product $product */
        $product = Product::create($data);
        $product->categories()->toggle($data['category']);

        return redirect(route('admin.product.index'));
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $productCategoryIds = array_keys($product->categories->groupBy('id')->all());
        return view('admin.product.edit',
            compact('product', 'categories', 'productCategoryIds')
        );
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Product $product): RedirectResponse
    {
        $data = request()->validate(
            [
                'name' => ['required', 'string'],
                'price' => ['required', 'numeric'],
                'description' => ['required', 'string'],
                'image' => ['image'],
                'category' => ['required']
            ]);

        if (request('image')) {
            $data['image'] = $this->resizeImageAndGetPath(request('image'));
        }

        $product->update($data);
        $this->resolveEditedCategories($product,
            array_map(function ($e) {
                return (int)$e;
            }, $data['category'])
        );

        return redirect(route('admin.product.index'));
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $productName = $product->name;
        $product->delete();
        return response()->json(['name' => $productName]);
    }

    /**
     * TODO: This method should be refactored
     * Selected categories should be attached to product.
     * Unselected categories should be detached.
     *
     * @param Product $product
     * @param array $selectedCategories
     * @return void
     */
    private function resolveEditedCategories(Product $product, array $selectedCategories): void
    {
        $allCategoryIds = array_keys(Category::all()->groupBy('id')->all());
        $productCategories = array_keys($product->categories->groupBy('id')->all());

        $unselectedCategories = array_diff($allCategoryIds, $selectedCategories);

        $categoriesToAttach = array_diff($selectedCategories, $productCategories);
        $categoriesToDetach = array_intersect($unselectedCategories, $productCategories);

        if ($categoriesToAttach) {
            $product->categories()->attach($categoriesToAttach);
        }

        if ($categoriesToDetach) {
            $product->categories()->detach($categoriesToDetach);
        }
    }

    /**
     * @param UploadedFile $oldImage
     * @return string
     */
    public function resizeImageAndGetPath(UploadedFile $oldImage): string
    {
        $imagePath = $oldImage->store('product_images', 'public');

        $newImage = Image::make(public_path('storage/' . $imagePath))->fit(1000, 1000);
        $newImage->save();

        return $imagePath;
    }
}
