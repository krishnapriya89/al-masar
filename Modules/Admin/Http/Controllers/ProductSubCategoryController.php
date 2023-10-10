<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\ProductMainCategory;
use App\Models\ProductSubCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\ProductSubCategoryRequest;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sub_categories = ProductSubCategory::latest()->get();
        return view('admin::product-sub-category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $main_categories = ProductMainCategory::active()->get();
        return view('admin::product-sub-category.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductSubCategoryRequest $request)
    {
        $sub_category = new ProductSubCategory();
        $sub_category->title = $request->title;
        $sub_category->product_main_category_id = $request->main_category;
        $sub_category->parent_id = $request->sub_category;
        $sub_category->is_last_child = $request->is_last_child;
        $sub_category->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $sub_category->status = $request->status;

        if ($sub_category->save()) {
            return to_route('product-sub-category.index')->with('success', 'Product Sub Category created successfully!');
        } else {
            return to_route('product-sub-category.index')->with('error', 'Failed to create Product Sub Category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $sub_category = ProductSubCategory::find(base64_decode($id));
        $main_categories = $sub_categories = collect([]);
        if ($sub_category) {
            $main_categories = ProductMainCategory::active()->get();
            if ($sub_category->product_main_category_id != NULL)
                $sub_categories = ProductSubCategory::where('product_main_category_id', $sub_category->product_main_category_id)
                    ->where('is_last_child', 0)->where('id', '!=', $sub_category->id)->active()->get();

            return view('admin::product-sub-category.edit', compact('sub_category', 'main_categories', 'sub_categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductSubCategoryRequest $request, ProductSubCategory $product_sub_category)
    {
        $product_sub_category->title = $request->title;
        $product_sub_category->product_main_category_id = $request->main_category;
        $product_sub_category->parent_id = $request->sub_category ?? NULL;
        $successMessage = 'Product Sub Category updated successfully!';
        if($request->is_last_child == 1) {
            if($product_sub_category->children->count() > 0)
                $successMessage = 'Cannot update the \'last child\' attribute to \'yes\' because it already has child categories. All other data has been updated.';
            else
                $product_sub_category->is_last_child = $request->is_last_child;
        }
        else
            $product_sub_category->is_last_child = $request->is_last_child;

        $product_sub_category->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $product_sub_category->status = $request->status;

        if ($product_sub_category->save()) {
            return to_route('product-sub-category.index')->with('success', $successMessage);
        } else {
            return to_route('product-sub-category.index')->with('error', 'Failed to update Product Sub Category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ProductSubCategory $product_sub_category)
    {
        if($product_sub_category->products->count() < 1 && $product_sub_category->children->count() < 1) {
            if ($product_sub_category->delete()) {
                return to_route('product-sub-category.index')->with('success', 'Product Sub Category deleted successfully!');
            } else {
                return to_route('product-sub-category.index')->with('error', 'Failed to delete Product Sub Category '. $product_sub_category->title);
            }
        } else {
            return to_route('product-sub-category.index')->with('error', 'Product Sub Category '. $product_sub_category->title .' tagged with products or have child categories.');
        }
    }
}
