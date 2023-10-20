<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\AuthPageCommonContent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthPageManageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function form($page)
    {
        $data = AuthPageCommonContent::page($page)->first();
        $type = 'Add';
        $method = 'Create';
        if($data){
            $type = 'Edit';
            $method = 'Update';
        }
        return view('admin::auth_page_cms.form', compact('data', 'page', 'type', 'method'));
    }

    public function store(Request $request, $page)
    {
        $request->validate([
            'form_title'         => 'required',
            'image'          => 'exclude_unless:id,NULL|required|max:2048|mimes:jpg,jpeg,webp,png',
            'thumb_image' => 'exclude_unless:id,NULL|required_if:file_type,Video'
        ]);

        if ($request->id == NULL || $request->id == '')
            $page_data = new AuthPageCommonContent();
        else
            $page_data = AuthPageCommonContent::find(base64_decode($request->id));

        $page_data->page = $page;
        $page_data->form_title = $request->form_title;
        $page_data->meta_title = $request->meta_title;
        $page_data->meta_keywords = $request->meta_keywords;
        $page_data->meta_description = $request->meta_description;
        $page_data->other_meta_tags = $request->other_meta_tags;

        if ($request->hasFile('image')) {
            if ($page_data->image != NULL && $page_data->image != '')
                $page_data->deleteImage('image');

            $file                = $request->file('image');
            $page_data->image   = $page_data->uploadImage($file, $page.'/'.$page_data->getImageDirectory());
        }

        if ($page_data->save()) {
            return redirect()->back()->with('success', ucwords(str_replace('_', ' ', $page)). ' page data saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to saving ' . ucwords(str_replace('_', ' ', $page)) . ' page data');
        }
    }
}
