<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($product_id)
    {
        $product = Product::find(base64_decode($product_id));
        if ($product) {
            return view('admin::product-gallery.index', compact('product'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($product_id)
    {
        $product = Product::find(base64_decode($product_id));
        if ($product) {
            return view('admin::product-gallery.create', compact('product'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request, $product_id)
    {
        $request->validate(
            [
                'file_type' => 'required|in:Image,Video',
                'image_files' => 'required_if:file_type,Image|array',
                'image_files.*' => 'image|mimes:jpg,jpeg,webp,png|max:2048',
                'video_file'     => 'required_if:file_type,Video|mimes:mp4',
                'thumb_image' => 'required_if:file_type,Video||image|mimes:jpg,jpeg,webp,png|max:2048'
            ],
            [
                'image_files.required_if' => 'This field is required',
                'image_files.*.image' => 'The file must be an image',
                'image_files.*.mimes' => 'The file must be an image',
                'image_files.*.max' => 'The file  file field must not be greater than 2MB.',
                'video_file.required_if' => 'This field is required',
                'video_file.mimes' => 'The file must be an video',
                'thumb_image.required_if' => 'This field is required',
                'thumb_image' => 'The file must be an image',
            ]
        );

        if ($request->hasFile('image_files')) {
            $image_count = $image_saved_count = 0;
            foreach ($request->file('image_files') as $image) {
                $image_count++;
                $gallery = new ProductGallery();
                $gallery->product_id = $product_id;
                $gallery->file_type = $request->file_type;
                $gallery->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
                $gallery->status = $request->status;
                $gallery->file = $gallery->uploadImage($image, $gallery->getImageDirectory());
                if($gallery->save())
                    $image_saved_count++;
            }
            if ($image_count == $image_saved_count) {
                return to_route('product-gallery.index', base64_encode($product_id))->with('success', 'Product Gallery created successfully.');
            } elseif($image_saved_count = 0) {
                return to_route('product-gallery.index', base64_encode($product_id))->with('error', 'Failed to create Product Gallery.');
            }
            else {
                return to_route('product-gallery.index', base64_encode($product_id))->with('error', 'Failed to Upload some Images.');
            }
        } elseif($request->hasFile('video_file')) {
            $gallery = new ProductGallery();
            $gallery->product_id = $product_id;
            $gallery->file_type = $request->file_type;
            $gallery->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
            $gallery->status = $request->status;
            if ($request->hasFile('video_file')) {
                $image = $request->file('video_file');
                $gallery->file = $gallery->uploadImage($image, $gallery->getImageDirectory());
            }

            if ($request->hasFile('thumb_image') && $request->file_type == 'Video') {
                $thumb_image = $request->file('thumb_image');
                $gallery->thumb_image = $gallery->uploadImage($thumb_image, $gallery->getImageDirectory());
            }

            if ($gallery->save()) {
                return redirect()->route('product-gallery.index', base64_encode($product_id))->with('success', 'Product Gallery created successfully.');
            } else {
                return redirect()->route('product-gallery.index', base64_encode($product_id))->with('error', 'Failed to create Product Gallery.');
            }
        }
        else {
            return back()->with('error', 'Please upload files');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Product $product, $id)
    {
        $gallery = ProductGallery::find(base64_decode($id));
        if ($gallery) {
            return view('admin::product-gallery.edit', compact('gallery', 'product'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $product, ProductGallery $gallery)
    {
        $request->validate([
            'file' => [
                'nullable',
                function ($attribute, $value, $fail) use ($gallery, $request) {
                    if ($gallery->file_type == 'Image') {
                        $request->validate(
                            [
                                'file' => 'image|mimes:jpg,jpeg,webp,png|max:2048|dimensions:min_width:1080,min_height:1080,max_width:1080,max_height:1080'
                            ],
                            [
                                'file' => 'The file must be an image'
                            ]
                        );
                    } else {
                        $request->validate(
                            [
                                'file'     => 'mimes:mp4',
                                'thumb_image' => 'required|image|mimes:jpg,jpeg,webp,png|max:2048|dimensions:min_width:1080,min_height:1080,max_width:1080,max_height:1080'
                            ],
                            [
                                'file'      => 'The file must be an video',
                                'thumb_image.required' => 'This field is required',
                                'thumb_image' => 'The file must be an image',
                            ]
                        );
                    }
                },
            ],
        ]);

        $gallery->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $gallery->status = $request->status;

        if ($request->hasFile('file')) {
            $gallery->deleteImage('file');
            $image = $request->file('file');
            $gallery->file = $gallery->uploadImage($image, $gallery->getImageDirectory());
        }

        if ($request->hasFile('thumb_image')) {
            $gallery->deleteImage('thumb_image');
            $thumb_image = $request->file('thumb_image');
            $gallery->thumb_image = $gallery->uploadImage($thumb_image, $gallery->getImageDirectory());
        }

        if ($gallery->save()) {
            return redirect()->route('product-gallery.index', base64_encode($gallery->product_id))->with('success', 'Product Gallery updated successfully.');
        } else {
            return redirect()->route('product-gallery.index', base64_encode($gallery->product_id))->with('error', 'Failed to update Product Gallery.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($product, ProductGallery $gallery)
    {
        if ($gallery->delete()) {
            return redirect()->route('product-gallery.index', base64_encode($product))->with('success', 'Gallery deleted successfully!');
        } else {
            return redirect()->route('product-gallery.index', base64_encode($product))->with('error', 'Failed to delete Gallery.');
        }
    }
}
