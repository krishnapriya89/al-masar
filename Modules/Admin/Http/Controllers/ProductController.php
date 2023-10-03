<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductSubCategory;
use Illuminate\Routing\Controller;
use App\Models\ProductMainCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Http\Requests\ProductRequest;
use Modules\Admin\Http\Requests\ProductCreateRequest;
use Modules\Admin\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin::product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $main_categories = ProductMainCategory::active()->get();
        return view('admin::product.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->product_main_category_id = $request->category;
        $product->product_sub_category_id = $request->sub_category;
        $product->product_sub_category_child_id = $request->sub_category_child;
        $product->description = $request->description;
        $product->vendor_id = $request->vendor ?? 1; //by default it 1 that is Al Masar
        $product->product_code = $request->product_code;
        $product->model_number = $request->model_number;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->search_keywords = $request->search_keywords;
        $product->stock = $request->filled('stock') ? $request->stock : 0;
        $product->min_stock = $request->filled('min_stock') ? $request->min_stock : 0;
        $product->stock_status = $request->stock_status;
        $product->base_price = $request->base_price ?? 0;
        $product->discount_type = $request->discount_type ?? 0;
        $product->discount = $request->discount ?? 0;
        $product->min_quantity_to_buy = $request->filled('min_quantity_to_buy') ?? 0;
        $product->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $product->status = $request->status;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        $product->other_meta_tags = $request->other_meta_tags;

        if ($request->hasFile('detail_page_image')) {
            $file = $request->file('detail_page_image');
            $product->detail_page_image = $product->uploadImage($file, $product->getImageDirectory());

            $image = $request->file('detail_page_image');
            $ImageUpload = Image::make($image);
            $image_path = $product->uploadImage($image, $product->getImageDirectory());
            $product->detail_page_image = $image_path;

            $ImageUpload->resize(18, 24, function ($constraint) {
                // $constraint->aspectRatio();
            });
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $fileName = 'uploads/' . $product->getImageDirectory() . '/' . $imageName;
            $filePath = 'public/uploads/' . $product->getImageDirectory() . '/' . $imageName;
            Storage::put($filePath, $ImageUpload->encode());
            $product->listing_image = $fileName;
        }

        if ($product->save()) {
            session()->flash('success', 'Product created successfully!');
            return response()->json(['status' => true, 'url' => 'product', 'message' => 'Product created successfully!']);
        }
        return response()->json(['status' => false, 'url' => 'product', 'message' => 'Failed to create Product.']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $product = Product::find(base64_decode($id));
        if($product) {
            $main_categories = ProductMainCategory::active()->get();
            $sub_categories = ProductSubCategory::active()->where('product_main_category_id', $product->product_main_category_id)->get();
            $sub_category_children = ProductSubCategory::active()->where('parent_id', $product->product_sub_category_id)->get();
            return view('admin::product.edit', compact('product', 'main_categories', 'sub_categories', 'sub_category_children'));
        }
        
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param Product $product
     * @return Renderable
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->title = $request->title;
        $product->product_main_category_id = $request->category;
        $product->product_sub_category_id = $request->sub_category;
        $product->product_sub_category_child_id = $request->sub_category_child;
        $product->description = $request->description;
        $product->vendor_id = $request->vendor ?? 1; //by default it 1 that is Al Masar
        $product->product_code = $request->product_code;
        $product->model_number = $request->model_number;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->search_keywords = $request->search_keywords;
        $product->stock = $request->filled('stock') ? $request->stock : 0;
        $product->min_stock = $request->filled('min_stock') ? $request->min_stock : 0;
        $product->stock_status = $request->stock_status;
        $product->base_price = $request->base_price ?? 0;
        $product->discount_type = $request->discount_type ?? 0;
        $product->discount = $request->discount ?? 0;
        $product->min_quantity_to_buy = $request->filled('min_quantity_to_buy') ?? 0;
        $product->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $product->status = $request->status;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        $product->other_meta_tags = $request->other_meta_tags;

        if ($request->hasFile('detail_page_image')) {
            $product->deleteImage('detail_page_image');
            $product->deleteImage('listing_image');

            $file = $request->file('detail_page_image');
            $product->detail_page_image = $product->uploadImage($file, $product->getImageDirectory());

            $image = $request->file('detail_page_image');
            $ImageUpload = Image::make($image);
            $image_path = $product->uploadImage($image, $product->getImageDirectory());
            $product->detail_page_image = $image_path;

            $ImageUpload->resize(18, 24, function ($constraint) {
                // $constraint->aspectRatio();
            });
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $fileName = 'uploads/' . $product->getImageDirectory() . '/' . $imageName;
            $filePath = 'public/uploads/' . $product->getImageDirectory() . '/' . $imageName;
            Storage::put($filePath, $ImageUpload->encode());
            $product->listing_image = $fileName;
        }

        if ($product->save()) {
            session()->flash('success', 'Product updated successfully!');
            return response()->json(['status' => true, 'url' => 'product', 'message' => 'Product created successfully!']);
        }
        return response()->json(['status' => false, 'url' => 'product', 'message' => 'Failed to create Product.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
        } else {
            return redirect()->route('product.index')->with('error', 'Failed to delete Product.');
        }
    }
}
