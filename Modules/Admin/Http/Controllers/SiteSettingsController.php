<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\SiteCommonContent;
use App\Models\ProductSubCategory;

class SiteSettingsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = SiteCommonContent::first();
        $categories = ProductSubCategory::whereNull('parent_id')->get();
        return view('admin::site-cms.edit',compact('common_content','categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email'=>'required|email'
        ]);
        $common_content = SiteCommonContent::find($id);
        $common_content->header_phone_number = $request->header_phone_number;
        $common_content->footer_description = $request->footer_description;
        $common_content->enquiry_receive_email = $request->enquiry_receive_email;
        $common_content->phone = $request->phone;
        $common_content->email = $request->email;
        $common_content->copy_right = $request->copy_right;
        $common_content->address = $request->address;
        $common_content->instagram_link = $request->instagram_link;
        $common_content->twitter_link = $request->twitter_link;
        $common_content->facebook_link = $request->facebook_link;
        $common_content->linkedIn_link = $request->linkedIn_link;



        $common_content->menu_category = $request->menu_category;
        if($request->hasFile('payment_image'))
        {
            if($common_content->payment_image != '' || $common_content->payment_image != NULL)
            $common_content->deleteImage('payment_image');
            $file = $request->file('payment_image');
            $common_content->payment_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($common_content->save())
        {
            return redirect()->back()->with('success','Site Common Settings Updated Successfully!');
        }
        return redirect()->back()->with('error','Failed to Update Site Common Settings');
    }

}
