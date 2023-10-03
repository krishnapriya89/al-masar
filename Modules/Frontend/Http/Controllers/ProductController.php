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
    public function product()
    {
        $products = Product::active()->paginate(25);
        return view('frontend::product', compact('products'));
    }
}
