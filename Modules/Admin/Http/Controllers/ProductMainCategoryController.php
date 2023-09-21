<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMainCategory;
use App\Models\ProductSubCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\ProductMainCategoryRequest;

class ProductMainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = ProductMainCategory::latest()->get();
        return view('admin::product-main-category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductMainCategoryRequest $request)
    {
        $main_category = new ProductMainCategory();
        $main_category->title = $request->title;
        $main_category->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $main_category->status = $request->status;

        if ($main_category->save()) {
            return to_route('product-main-category.index')->with('success', 'Product Main Category created successfully!');
        } else {
            return to_route('product-main-category.index')->with('error', 'Failed to create Product Main Category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category = ProductMainCategory::find(base64_decode($id));
        return view('admin::product-main-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductMainCategoryRequest $request, ProductMainCategory $product_main_category)
    {
        $product_main_category->title = $request->title;
        $product_main_category->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $product_main_category->status = $request->status;

        if ($product_main_category->save()) {
            return to_route('product-main-category.index')->with('success', 'Product Main Category updated successfully!');
        } else {
            return to_route('product-main-category.index')->with('error', 'Failed to update Product Main Category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ProductMainCategory $main_category)
    {
        if($main_category->sub_categories->count() < 1 && $main_category->products->count() < 1){
            if ($main_category->delete()) {
                return to_route('product-main-category.index')->with('success', 'Product Main Category deleted successfully!');
            } else {
                return to_route('product-main-category.index')->with('error', 'Failed to delete Product Main Category '.$main_category->title);
            }
        } else {
            return to_route('product-main-category.index')->with('error', 'Product Main Category '. $main_category->title .' tagged with sub categories or product');
        }
    }

    //return sub categories who are likely to have a child
    public function getNotLastChildSubCategories(ProductMainCategory $category){
        return response()->json($category->sub_categories->where('status', 1)->where('is_last_child', 0));
    }

    //return all subcategories under the category
    public function getSubCategories(ProductMainCategory $category){
       
        return response()->json($category->sub_categories->where('status', 1));
    }

    //return all subcategories under the categories
    public function getMultipleSubCategories($categories){
        return response()->json(ProductSubCategory::whereIn('product_main_category_id', explode(',',$categories))->where('status', 1)->get());
    }

    // //return all products under the subcategories
    // public function getSubCategoriesProducts($sub_categories){
    //     return response()->json(Product::whereIn('product_sub_category_id', explode(',',$sub_categories))->where([['status', 1], ['has_variant',0]])->get());
    // }
}
