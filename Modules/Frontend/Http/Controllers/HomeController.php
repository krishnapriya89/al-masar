<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Product;
use App\Models\HowToBuy;
use App\Models\WhyChoose;
use App\Models\HomeBanner;
use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use App\Models\NotifyProduct;
use App\Models\PrivacyPolicy;
use App\Models\ContactEnquiry;
use App\Models\SiteCommonContent;
use App\Models\TermsAndCondition;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;

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
        return view('frontend::index', compact('home_banners', 'about_us_common', 'why_choose', 'how_to_buy', 'contact'));
    }

    /**
     * about us page
     *
     */
    public function about()
    {
        $about = AboutUs::first();
        return view('frontend::about', compact('about'));
    }

    /**
     * Privacy Policy
     *
     */
    public function privacyPolicy()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('frontend::privacy-policy', compact('privacy_policy'));
    }

    /**
     * Terms and conditions
     *
     */
    public function termsAndConditions()
    {
        $terms_conditions = TermsAndCondition::first();
        return view('frontend::terms-and-conditions', compact('terms_conditions'));
    }

    /**
     * Store Contact Enquiry
     *
     */
    public function storeContact(Request $request, ContactEnquiry $contact_enquiry)
    {
        $contact_enquiry->name = $request->name;
        $contact_enquiry->email = $request->email;
        $contact_enquiry->phone = $request->phone;
        $contact_enquiry->subject = $request->subject;
        $contact_enquiry->message = $request->message;
        if ($contact_enquiry->save())
         {
            $siteSettings = SiteCommonContent::first();
            return view('frontend::emails.contact-mail-admin', compact('contact_enquiry', 'siteSettings'));
            Mail::send('frontend::emails.contact-mail-user', ['contact_enquiry' => $contact_enquiry,'siteSettings'=>$siteSettings], function ($message) use($contact_enquiry,$siteSettings) {
                $message->to($contact_enquiry->email);
                $message->subject('Al Masar Al Saree - Contact Send Successfully!');
            });
            Mail::send('frontend::emails.contact-mail-admin', ['contact_enquiry' => $contact_enquiry,'siteSettings'=>$siteSettings], function ($message) use($contact_enquiry,$siteSettings) {
                $message->to($siteSettings->enquiry_receive_email);
                $message->subject('Al Masar Al Saree - Receive Contact Application !');
            });
            return redirect()->back()->with('success', 'Contact Form Application Submitted Successfully!');
        }
        return to_route('home')->with('error', 'Failed to Submit Contact Form Application');
    }


    /**
     * Currency changing while page loading and all times
     *
     */
    public function changeCurrency($code)
    {
        $default_currency = CurrencyRate::first();
        if ($code != '') {
            $currency = CurrencyRate::active()
                ->whereHas('currencyCode', function ($query) use ($code) {
                    $query->where('code', $code);
                })
                ->first();
            if ($currency) {
                Session::put('currency_rate', $currency->rate);
                Session::put('currency_symbol', $currency->symbol);
                Session::put('currency_code', $currency->currencyCode->code);
                return response()->json([
                    'status' => true
                ]);
            } else {
                Session::put('currency_rate', $default_currency->rate);
                Session::put('currency_symbol', $default_currency->symbol);
                Session::put('currency_code', $default_currency->currencyCode->code);
                return response()->json([
                    'status' => true
                ]);
            }
        } else {
            Session::put('currency_rate', $default_currency->rate);
            Session::put('currency_symbol', $default_currency->symbol);
            Session::put('currency_code', $default_currency->currencyCode->code);
            return response()->json([
                'status' => true
            ]);
        }
    }

    /**
     * Send Notify mail to user
     *
     */
    public function notifyUser()
    {
        $notify_products = NotifyProduct::where('isNotified',0)->get();
        foreach($notify_products as $product)
        {

            $user_email = $product->user->email;
            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.product-notify-user', ['data' => $product,'siteSettings'=>$siteSettings], function ($message) use ($user_email) {
                $message->to($user_email);
                $message->subject('You send a product request to notify');
            });
            $product->update(['isNotified'=>1]);

        }
    }

    public function error_404() {
        return view('frontend::errors.404');
    }
}
