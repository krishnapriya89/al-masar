<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\HomeBanner;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\ContactEnquiry;
use App\Models\HowToBuy;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use App\Models\WhyChoose;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * home page
     *
     */
    public function index()
    {
        $home_banners = HomeBanner::active()->orderBy('sort_order')->get();
        $about_us_common = AboutUs::first();
        $why_choose = WhyChoose::first();
        $how_to_buy = HowToBuy::first();
        $contact = Contact::first();
        return view('frontend::index',compact('home_banners','about_us_common','why_choose','how_to_buy','contact'));
    }

    /**
     * about us page
     *
     */
    public function about()
    {
        $about = AboutUs::first();
        return view('frontend::about',compact('about'));
    }

    /**
     * Privacy Policy
     *
     */
    public function privacyPolicy()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('frontend::privacy-policy',compact('privacy_policy'));
    }

    /**
     * Terms and conditions
     *
     */
    public function termsAndConditions()
    {
        $terms_conditions = TermsAndCondition::first();
        return view('frontend::terms-and-conditions',compact('terms_conditions'));
    }

    /**
     * Store Contact Enquiry
     *
     */
    public function storeContact(Request $request,ContactEnquiry $contact_enquiry)
    {
        $contact_enquiry->name = $request->name;
        $contact_enquiry->email = $request->email;
        $contact_enquiry->phone = $request->phone;
        $contact_enquiry->subject = $request->subject;
        $contact_enquiry->message = $request->message;
        if($contact_enquiry->save())
        {
            return redirect()->back()->with('success','Contact Form Application Submitted Successfully!');
        }
        return redirect()->back()->with('error','Failed to Submit Contact Form Application');
    }

    /**
     * Product Detail Page
     *
     */
    public function productDetailPage($slug)
    {
        $product = Product::active()->where('slug',$slug)->first();
        return view('frontend::product-detail',compact('product'));
    }





}
