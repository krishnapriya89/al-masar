<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\NotifyProduct;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     * @return Renderable
     */
    public function products()
    {
        $products = Product::active()->orderBy('sort_order')->paginate(25);
        return view('frontend::product', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::active()
        ->when($request->filled('product_code'), function ($query) use ($request) {
            $query->where('product_code', 'like', '%'. $request->input('product_code') . '%');
        })
        ->when($request->filled('product_name'), function ($query) use ($request) {
            $query->where('product_name', 'like', '%'. $request->input('product_name') . '%');
        })
        ->when($request->filled('model_number'), function ($query) use ($request) {
            $query->where('model_number', 'like', '%'. $request->input('model_number') . '%');
        })
        ->orderBy('sort_order')->paginate(25);

        $product_code = $request->product_code;
        $product_name = $request->product_name;
        $model_number = $request->model_number;

        return view('frontend::includes.product-list', compact('products', 'product_code', 'product_name', 'model_number'));
    }

     /**
     * Product Detail Page
     *
     */
    public function productDetailPage($slug)
    {
        $product = Product::active()->where('slug',$slug)->first();
        
        $product_galleries = $product->gallery;
        return view('frontend::product-detail',compact('product','product_galleries'));
    }

    /**
     * Notify me
     *
     */
    public function notifyMe(Request $request)
    {
        $product = Product::where('slug',$request->product_slug)->first();
        if(!$product)
        {
            return response()->json([
                'status' => false,
                'message' => 'The Requested Product is not Found!'
            ]);
        }
        $notify_count = NotifyProduct::where('user_id',Auth::id())->where('product_id',$product->id)->where('isNotified',0)->count();
        if($notify_count>0){
            return response()->json([
                'status' => false,
                'message' => 'You are already requested to notify'
            ]);
        }

            $notify_product =  new NotifyProduct();
            $notify_product->product_id = $product->id;
            $notify_product->user_id = Auth::id();
            $notify_product->isNotified = 0;
            if($notify_product->save())
            {
                $site_settings = SiteCommonContent::first();
                Mail::send('frontend::emails.product-notify', ['data' => $notify_product], function ($message) use ($site_settings) {
                    $message->to($site_settings->email);
                    $message->subject('You send a product request to notify');
                });
                return response()->json([
                    'status' => true,
                    'message' => 'The Requested Product is Notified!'
                ]);
            }
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong ,Please try after some time'
                ]);
            }

    }

}
