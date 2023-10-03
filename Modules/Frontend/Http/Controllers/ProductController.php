<?php

namespace Modules\Frontend\Http\Controllers;

use App\Helpers\FrontendHelper;
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

    public function calculatePrice(Request $request)
    {
        $product = Product::active()->where('slug', $request->product)->first();
        if(!$product) {
            return response()->json([
                'status' => false,
                'message' => 'The requested product not found!'
            ]);
        }

        if($request->quantity < $product->min_quantity_to_buy) {
            return response()->json([
                'status' => false,
                'message' => 'Please enter the quantity greater than of min quantity!'
            ]);
        }

        $price = $product->price * $request->quantity;

        return response()->json([
            'status' => true,
            'message' => '',
            'price' =>  FrontendHelper::getCurrencySymbolWithConvertedPrice($price)
        ]);
    }
}
