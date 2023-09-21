<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\WhyChoose;

class WhyChooseController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = WhyChoose::first();
        return view('admin::why-choose.edit',compact('common_content'));
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
            'title'=>'required',
        ]);
        $common_content = WhyChoose::find($id);
        $common_content->title = $request->title;
        $common_content->sub_title = $request->sub_title;
        $common_content->section_one_title = $request->section_one_title;
        $common_content->section_one_description = $request->section_one_description;
        $common_content->section_two_title = $request->section_two_title;
        $common_content->section_two_description = $request->section_two_description;
        $common_content->section_three_title = $request->section_three_title;
        $common_content->section_three_description = $request->section_three_description;

        if($request->hasFile('section_one_image'))
        {
            if($common_content->section_one_image != '' || $common_content->section_one_image != NULL)
            $common_content->deleteImage('section_one_image');
            $file = $request->file('section_one_image');
            $common_content->section_one_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('section_two_image'))
        {
            if($common_content->section_two_image != '' || $common_content->section_two_image != NULL)
            $common_content->deleteImage('section_two_image');
            $file = $request->file('section_two_image');
            $common_content->section_two_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($request->hasFile('section_three_image'))
        {
            if($common_content->section_three_image != '' || $common_content->section_three_image != NULL)
            $common_content->deleteImage('section_three_image');
            $file = $request->file('section_three_image');
            $common_content->section_three_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($common_content->save())
        {
            return redirect()->back()->with('success','Why Choose Details Updated SUccessfully!');
        }
        return redirect()->back()->with('error','Failed to Update Why Choose Details');
    }

}
