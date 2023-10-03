<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     * @return Renderable
     */
    public function products()
    {
        $products = Product::active()->orderBy('sort_order')->get();
        return view('frontend::product', compact('products'));
    }

    //product listing page search
    public function listSearch(Request $request)
    {
        $products = Product::active()
        ->when($request->filled('product_code'), function ($query) use ($request) {
            $query->where('product_code', 'like', '%'. $request->input('product_code') . '%');
        })
        ->when($request->filled('product_name'), function ($query) use ($request) {
            $query->where('title', 'like', '%'. $request->input('product_name') . '%');
        })
        ->when($request->filled('model_number'), function ($query) use ($request) {
            $query->where('model_number', 'like', '%'. $request->input('model_number') . '%');
        })
        ->orderBy('sort_order')->get();

        $product_code = $request->product_code;
        $product_name = $request->product_name;
        $model_number = $request->model_number;

        return view('frontend::includes.product-list', compact('products', 'product_code', 'product_name', 'model_number'));
    }
}