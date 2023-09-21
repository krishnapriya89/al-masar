<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\AboutUs;

class AboutUsController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = AboutUs::first();
        return view('admin::about-us.edit',compact('common_content'));
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
            'banner_title' => 'required',
            'title'        => 'required',
            'image'        => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'banner_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'mission_bg_image'=> 'nullable|image|mimes:png,jpg,jpeg,webp',
            'vision_bg_image'=> 'nullable|image|mimes:png,jpg,jpeg,webp',
            'values_bg_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'section_one_value_one'=> 'nullable|min:0',
            'section_one_value_two'=> 'nullable|min:0',
            'section_one_value_three'=> 'nullable|min:0',
            'section_one_value_four'=> 'nullable|min:0',
        ]);
        $common_content  = AboutUs::find($id);
        $common_content->banner_title = $request->banner_title;
        $common_content->banner_description = $request->banner_description;
        $common_content->title = $request->title;
        $common_content->sub_title = $request->sub_title;
        $common_content->description = $request->description;
        $common_content->home_page_button_name = $request->home_page_button_name;
        $common_content->home_page_button_link = $request->home_page_button_link;
        $common_content->section_one_value_one = $request->section_one_value_one;
        $common_content->section_one_title_one = $request->section_one_title_one;
        $common_content->section_one_value_two = $request->section_one_value_two;
        $common_content->section_one_title_two = $request->section_one_title_two;
        $common_content->section_one_value_three = $request->section_one_value_three;
        $common_content->section_one_title_three = $request->section_one_title_three;
        $common_content->section_one_value_four = $request->section_one_value_four;
        $common_content->section_one_title_four = $request->section_one_title_four;
        $common_content->mission_title = $request->mission_title;
        $common_content->mission_description = $request->mission_description;
        $common_content->vision_title = $request->vision_title;
        $common_content->vision_description = $request->vision_description;
        $common_content->values_title = $request->values_title;
        $common_content->values_description = $request->values_description;
        $common_content->meta_title = $request->meta_title;
        $common_content->meta_keywords = $request->meta_keywords;
        $common_content->meta_description = $request->meta_description;
        $common_content->other_meta_tags = $request->other_meta_tags;
        if($request->hasFile('image'))
        {
            if($common_content->image != '' || $common_content->image != NULL)
            $common_content->deleteImage('image');
            $file = $request->file('image');
            $common_content->image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('banner_image'))
        {
            if($common_content->banner_image != '' || $common_content->banner_image != NULL)
            $common_content->deleteImage('banner_image');
            $file = $request->file('banner_image');
            $common_content->banner_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('mission_bg_image'))
        {
            if($common_content->mission_bg_image != '' || $common_content->mission_bg_image != NULL)
            $common_content->deleteImage('mission_bg_image');
            $file = $request->file('mission_bg_image');
            $common_content->mission_bg_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('vision_bg_image'))
        {
            if($common_content->vision_bg_image != '' || $common_content->vision_bg_image != NULL)
            $common_content->deleteImage('vision_bg_image');
            $file = $request->file('vision_bg_image');
            $common_content->vision_bg_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('values_bg_image'))
        {
            if($common_content->values_bg_image != '' || $common_content->values_bg_image != NULL)
            $common_content->deleteImage('values_bg_image');
            $file = $request->file('values_bg_image');
            $common_content->values_bg_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($common_content->save())
        {
            return redirect()->back()->with('success','About Us Details Updated Successfully!');
        }
        return redirect()->back()->with('error','Failed to Update About Us Details');
    }


}
