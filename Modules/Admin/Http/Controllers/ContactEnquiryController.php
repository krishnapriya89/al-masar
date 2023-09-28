<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ContactEnquiry;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $enquiries = ContactEnquiry::latest()->get();
        return view('admin::contact-enquiry.index',compact('enquiries'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $contact_reply = ContactEnquiry::find(base64_decode($id));
        return view('admin::contact-enquiry.view',compact('contact_reply'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ContactEnquiry $contact_enquiry_listing)
    {
        if($contact_enquiry_listing->delete())
        {
            return redirect()->back()->with('success','Contact Enquiry Deleted Successfully!');
        }
        return redirect()->back()->with('error','Failed to Delete Contact Enquiry');
    }

    /**
     * Add Reply
     *
     */
    public function addReply(Request $request)
    {
        $request->validate([
            'reply' => 'required',
        ],
        [
            'reply' => 'Please add your Reply',
        ]);
        $contact = ContactEnquiry::find($request->contact_id);
       $contact->reply   = $request->reply;
       $contact->save();
       return redirect()->back()->with('success','Reply send Successfully!');
    }
}
