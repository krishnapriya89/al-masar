<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\HomeBannerRequest;
use App\Models\HomeBanner;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $home_banners = HomeBanner::latest()->get();
        return view('admin::home-banner.index',compact('home_banners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::home-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(HomeBannerRequest $request,HomeBanner $home_banner)
    {

        $home_banner->title         = $request->title;
        $home_banner->sub_title     = $request->sub_title;
        $home_banner->button_name   = $request->button_name;
        $home_banner->button_link   = $request->button_link;
        $home_banner->sort_order     = $request->filled('sort_order') ? $request->sort_order:0;
        $home_banner->status        = $request->status;
        if($request->hasFile('web_image'))
        {
            $file = $request->file('web_image');
            $home_banner->web_image = $home_banner->uploadImage($file, $home_banner->getImageDirectory());
        }
        if($request->hasFile('mob_image'))
        {
            $file = $request->file('mob_image');
            $home_banner->mob_image = $home_banner->uploadImage($file, $home_banner->getImageDirectory());
        }
        if($home_banner->save())
        {
            return to_route('home-banner.index')->with('success','Home Banner Added Successfully!');
        }
        return to_route('home-banner.index')->with('error','Filed to Add Home Banner');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $home_banner = HomeBanner::find(base64_decode($id));
        return view('admin::home-banner.edit',compact('home_banner'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(HomeBannerRequest $request,HomeBanner $home_banner)
    {
        $home_banner->title         = $request->title;
        $home_banner->sub_title     = $request->sub_title;
        $home_banner->button_name   = $request->button_name;
        $home_banner->button_link   = $request->button_link;
        $home_banner->sort_order     = $request->filled('sort_order') ? $request->sort_order:0;
        $home_banner->status        = $request->status;
        if($request->hasFile('web_image'))
        {
            if($home_banner->web_image != '' || $home_banner->web_image != NULL)
            $home_banner->deleteImage('web_image');
            $file = $request->file('web_image');
            $home_banner->web_image = $home_banner->uploadImage($file, $home_banner->getImageDirectory());
        }
        if($request->hasFile('mob_image'))
        {
            if($home_banner->mob_image != '' || $home_banner->mob_image != NULL)
            $home_banner->deleteImage('mob_image');
            $file = $request->file('mob_image');
            $home_banner->mob_image = $home_banner->uploadImage($file, $home_banner->getImageDirectory());
        }
        if($home_banner->save())
        {
            return to_route('home-banner.index')->with('success','Home Banner Updated Successfully!');
        }
        return to_route('home-banner.index')->with('error','Filed to Update Home Banner');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(HomeBanner $home_banner)
    {
        if($home_banner->delete())
        {
            return redirect()->back()->with('success','Home Banner Deleted Successfully!');
        }
        return redirect()->back()->with('error','Failed To Delete Home Banner');
    }
}
