<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TermsAndCondition;

class TermsAndConditionsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $common_content = TermsAndCondition::first();
        return view('admin::terms-and-conditions.edit',compact('common_content'));
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
        ]);
        $common_content = TermsAndCondition::find($id);
        $common_content->title = $request->title;
        $common_content->description = $request->description;
        $common_content->meta_title = $request->meta_title;
        $common_content->meta_keywords = $request->meta_keywords;
        $common_content->meta_description = $request->meta_description;
        $common_content->other_meta_tags = $request->other_meta_tags;
        if($common_content->save())
        {
            return redirect()->back()->with('success','Terms And Conditions Details Updated Successfully!');
        }
        return redirect()->back()->with('error',' Failed to Update Terms And Conditions Details');
    }

}
