<?php

namespace Modules\Frontend\Http\Controllers;

use App\Helpers\FrontendHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\NotifyProduct;
use App\Models\ProductSubCategory;
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
    public function products(Request $request)
    {
        $breadcrumb = $page_title = 'Products';
        $keyword    = trim(preg_replace('!\s+!', ' ', $request->input('search')));
        $query = Product::active();
        if ($keyword) {

            $page_title = 'Search Result of '. '\'' . $keyword .'\'';
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')->orWhere('product_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('model_number', 'LIKE', '%' . $keyword . '%');
                $query->orWhereHas('category', function ($sub_query) use ($keyword) {
                    $sub_query->where('title', 'LIKE', '%' . $keyword . '%');
                });
                $query->orWhereHas('subCategory', function ($sub_query) use ($keyword) {
                    $sub_query->where('title', 'LIKE', '%' . $keyword . '%');
                });
            });
        }
        $products = $query->orderBy('sort_order')->get();
        return view('frontend::product', compact('products', 'breadcrumb', 'page_title','keyword'));
    }

    //product listing page search
    public function listSearch(Request $request)
    {
        $products = Product::active()
            ->when($request->filled('product_code'), function ($query) use ($request) {
                $query->where('product_code', 'like', '%' . $request->input('product_code') . '%');
            })
            ->when($request->filled('product_name'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('product_name') . '%');
            })
            ->when($request->filled('model_number'), function ($query) use ($request) {
                $query->where('model_number', 'like', '%' . $request->input('model_number') . '%');
            })
            ->orderBy('sort_order')->get();

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
        $product = Product::active()->where('slug', $slug)->first();
        $product_galleries = $product->gallery->where('status',1)->sortBy('sort_order');
        return view('frontend::product-detail', compact('product', 'product_galleries'));
    }

    /**
     * Notify me
     *
     */
    public function notifyMe(Request $request)
    {
        $product = Product::where('slug', $request->product_slug)->first();
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'The Requested Product is not Found!'
            ]);
        }
        $notify_count = NotifyProduct::where('user_id', Auth::guard('web')->id())->where('product_id', $product->id)->where('isNotified', 0)->count();
        if ($notify_count > 0) {
            return response()->json([
                'status' => false,
                'message' => 'You are already requested to notify'
            ]);
        }

        $notify_product =  new NotifyProduct();
        $notify_product->product_id = $product->id;
        $notify_product->user_id = Auth::guard('web')->id();
        $notify_product->isNotified = 0;
        if ($notify_product->save()) {
            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.product-notify', ['data' => $notify_product,'siteSettings'=>$siteSettings], function ($message) use ($siteSettings) {
                $message->to($siteSettings->email);
                $message->subject('You Received a Product Notification');
            });
            return response()->json([
                'status' => true,
                'message' => 'The Requested Product is Notified!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong ,Please try after some time'
            ]);
        }
    }

    //calculate total price of a product in product list page
    public function calculatePrice(Request $request)
    {
        $product = Product::active()->where('slug', $request->product)->first();
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'The requested product not found!'
            ]);
        }

        if ($request->quantity < $product->min_quantity_to_buy) {
            return response()->json([
                'status' => false,
                'message' => 'Please enter the quantity greater than of min quantity!'
            ]);
        }

        if ($request->bid_price)
            $price = $request->bid_price * $request->quantity;
        else
            $price = $product->price * $request->quantity;

        return response()->json([
            'status' => true,
            'message' => '',
            'price' =>  FrontendHelper::getCurrencySymbolWithConvertedPrice($price)
        ]);
    }

    //product main search
    public function searchProduct(Request $request)
    {
        $keyword    = trim(preg_replace('!\s+!', ' ', $request->input('keyword')));
        $query = Product::active();
        $query->where(function ($query) use ($keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')->orWhere('product_code', 'LIKE', '%' . $keyword . '%')
                ->orWhere('model_number', 'LIKE', '%' . $keyword . '%')->orWhere('search_keywords', 'LIKE', '%' . $keyword . '%');
            $query->orWhereHas('category', function ($sub_query) use ($keyword) {
                $sub_query->where('title', 'LIKE', '%' . $keyword . '%');
            });
            $query->orWhereHas('subCategory', function ($sub_query) use ($keyword) {
                $sub_query->where('title', 'LIKE', '%' . $keyword . '%');
            });
        });
        $searched_products = $query->orderBy('sort_order')->get();
        return view('frontend::includes.modal-search-product-ist', compact('searched_products'));
    }

    //Category listing
    public function category($slug)
    {
        $sub_category = ProductSubCategory::active()->where('slug',$slug)->first();
        if($sub_category)
        {
            $breadcrumb = $page_title = $sub_category->title;
            $query = Product::query();
            if($sub_category->parent)
            {
                $query = $query->where('product_sub_category_child_id',$sub_category->id);
            }
            else{
                $query = $query->where('product_sub_category_id', $sub_category->id);
            }

            $products = $query->active()->orderBy('sort_order')->get();
            return view('frontend::product', compact('products', 'breadcrumb', 'page_title'));
        }
        $breadcrumb = $page_title = 'Products';
        return 404;

    }
}
