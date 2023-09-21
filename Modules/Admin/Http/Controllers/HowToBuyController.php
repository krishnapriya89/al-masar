<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\HowToBuy;

class HowToBuyController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = HowToBuy::first();
        return view('admin::how-to-buy.edit',compact('common_content'));
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
        $common_content = HowToBuy::find($id);
        $common_content->title = $request->title;
        $common_content->sub_title = $request->sub_title;
        $common_content->section_one_title = $request->section_one_title;
        $common_content->section_one_description = $request->section_one_description;
        $common_content->section_two_title = $request->section_two_title;
        $common_content->section_two_description = $request->section_two_description;
        $common_content->section_three_title = $request->section_three_title;
        $common_content->section_three_description = $request->section_three_description;

        if($request->hasFile('image'))
        {
            if($common_content->image != '' || $common_content->image != NULL)
            $common_content->deleteImage('image');
            $file = $request->file('image');
            $common_content->image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
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
            return redirect()->back()->with('success','How To Buy Details Updated SUccessfully!');
        }
        return redirect()->back()->with('error','Failed to Update How To Buy Details');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
