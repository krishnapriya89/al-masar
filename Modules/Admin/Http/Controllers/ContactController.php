<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Contact;

class ContactController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = Contact::first();
        return view('admin::contact.edit',compact('common_content'));
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
            'title' => 'required',
            'background_image'=>'nullable|image|mimes:png,jpg,jpeg,webp',
            'application_form_title'=> 'required',
            'phone'     => 'nullable|integer|digits_between:5,20',
            'email'     => 'nullable|email',
        ]);
        $common_content = Contact::find($id);
        $common_content->title = $request->title;
        $common_content->application_form_title = $request->application_form_title;
        $common_content->description        = $request->description;
        $common_content->phone              = $request->phone;
        $common_content->email              = $request->email;
        if($request->hasFile('background_image'))
        {
            if($common_content->background_image != '' || $common_content->background_image != NULL)
            $common_content->deleteImage('background_image');
            $file = $request->file('background_image');
            $common_content->background_image = $common_content->uploadImage($file, $common_content->getImageDirectory());
        }
        if($common_content->save())
        {
            return redirect()->back()->with('success','Contact Details Added Successfully!');
        }
        return redirect()->back()->with('error',' Failed to Update Contact Details');
    }
}
