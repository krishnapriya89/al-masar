<?php
namespace Modules\Frontend\Http\Controllers;
use App\Models\Order;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\OrderDetail;
use App\Models\UserAddress;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\TaxManagement;
use App\Helpers\FrontendHelper;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Emails\OrderCompletedAdmin;
use Modules\Frontend\Emails\OrderCompletedUser;
use Modules\Frontend\Emails\OrderConfirmationAdmin;
use Modules\Frontend\Emails\OrderConfirmationUser;
use Modules\Frontend\Http\Requests\CheckoutRequest;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($uid)
    {
        if (!$uid)
            return to_route('product')->with('error', 'Something went wrong');
        $quotation = Quotation::where('uid', $uid)
            ->where('user_id', Auth::guard('web')->id())
            ->first();
        if (!$quotation)
            return to_route('user.quotation')->with('error', 'No quotation found.');
        if ($quotation->quotationDetails->whereIn('status', [0, 1])->count() > 1 || $quotation->acceptedQuotationDetails->count() < 1)
            return to_route('user.quotation')->with('error', 'No accepted quotations were found or Some quotation is not accepted.');
        $countries          = Country::all();
        $billing_addresses  = UserAddress::where('user_id', auth()->id())
            ->where('type', 1)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        $shipping_addresses = UserAddress::where('user_id', auth()->id())
            ->where('type', 2)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        $payment_methods = Payment::active()->orderBy('sort_order')->get();
        $total_tax_amount = 0;
        $site_settings = TaxManagement::first();
        $default_shipping_address = $shipping_addresses->first();
        if ($default_shipping_address && $default_shipping_address->state->free_zone == 1) {
            if ($site_settings->tax_percentage) {
                $total_tax_amount += (($quotation->converted_total_bid_price * $site_settings->tax_percentage) / 100);
            }
            if ($site_settings->tax_amount) {
                $total_tax_amount += $site_settings->tax_amount * $quotation->currency_rate;
            }
        }
        return view('frontend::checkout.index', compact('quotation', 'countries', 'billing_addresses', 'shipping_addresses', 'payment_methods', 'site_settings', 'total_tax_amount'));
    }
    //checkout validation
    public function checkoutValidation(CheckoutRequest $request)
    {
        return response()->json([
            'status' => true
        ]);
    }
    //checkout
    public function checkout(Request $request)
    {
        $quotation = Quotation::where('uid', $request->quotation_uid)
            ->where('user_id', Auth::guard('web')->id())
            ->first();
        if (!$quotation || $quotation->quotationDetails->whereIn('status', [0, 1])->count() > 1 || $quotation->acceptedQuotationDetails->count() < 1) {
            return to_route('user.quotation')->with('error', 'Something went wrong please try again.');
        }

        $checkOrderExist = Order::where('uid', $request->quotation_uid)->first();
        if($checkOrderExist)
            return to_route('user.quotation')->with('error', 'You have already processed this order');

        $order = $this->createOrder($request, $quotation);
        if ($order) {
            $order_address = $this->createOrderAddress($request, $order);
            if ($order_address) {
                if ($order->payment_id == 1) {
                    return redirect()->route('user.bank.transfer', ['uid' => $order->uid]);
                } else {
                    return to_route('user.quotation')->with('success', 'Order Completed');
                }
            }
        } else {
            return to_route('user.quotation')->with('error', 'The requested quotation was not found.');
        }
        return redirect()->route('user.quotation');
    }
    public function createOrder($request, $quotation)
    {
        $order = new Order();
        $order->uid = $quotation->uid;
        $order->user_id = auth()->id();
        $order->sub_total = $quotation->acceptedQuotationDetails->sum('total_price');
        $order->bid_sub_total = $quotation->acceptedQuotationDetails->sum('total_bid_price');
        $order->payment_id = $request->selected_payment_method;
        $order->currency_code = FrontendHelper::getCurrencyCode();
        $order->currency_symbol = FrontendHelper::getCurrencySymbol();
        $order->currency_rate = FrontendHelper::getCurrencyRate();
        $order->tax_name = '';
        $order->tax_percentage = 0;
        $order->tax_value = 0;
        $order->tax_amount = 0;
        if ($request->selected_billing_shipping_same) {
            $shipping_address_id = $request->selected_billing_address;
        } else {
            $shipping_address_id = $request->selected_shipping_address;
        }
        $temp_request = app(Request::class);
        $temp_request->address_id = $shipping_address_id;
        $temp_request->quotation_uid = $quotation->uid;
        $tax_response = $this->checkTaXApplicableForAddress($temp_request);
        $tax_data = [];
        if ($tax_response) {
            $tax_data = json_decode($tax_response->getContent(), true);
            if ($tax_data['status']) {
                $order->tax_name = $tax_data['tax']['tax_name'] ?? '';
                $order->tax_percentage = $tax_data['tax']['tax_percentage'] ?? 0;
                $order->tax_value = $tax_data['tax']['tax_amount'] ?? 0;
                $order->tax_amount = $tax_data['total_tax_amount'] ?? 0;
            }
        }

        $order->grand_total = $quotation->total_bid_price + $order->tax_amount;
        $order->payment_gateway_status = 0;
        $order->order_status_id = null;
        $order->status = 0;
        $order->payment_received_status = 0;
        $order->payment_received_amount = 0;
        $order->admin_remarks = null;
        if ($order->save()) {
            if ($this->createOrderDetails($order, $quotation)) {
                return $order;
            }
        }
    }
    private function createOrderDetails($order, $quotation)
    {
        try {
            foreach ($quotation->acceptedQuotationDetails as $quotation_detail) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $quotation_detail->product_id;
                $order_detail->price = $quotation_detail->price;
                $order_detail->bid_price = $quotation_detail->bid_price;
                $order_detail->quantity = $quotation_detail->quantity;
                $order_detail->total = $quotation_detail->total_price;
                $order_detail->total_bid_price = $quotation_detail->total_bid_price;
                $order_detail->order_status_id = null;
                if ($order_detail->save()) {
                    $this->createOrderProduct($order_detail);
                }
            }
            $order->status = 1;
            if ($order->save()) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    private function createOrderProduct($order_details)
    {
        $product = Product::find($order_details->product_id);
        if ($product) {
            $order_product = new OrderProduct();
            $order_product->order_detail_id = $order_details->id;
            $order_product->title = $product->title;
            $order_product->slug = $product->slug;
            $order_product->product_code = $product->product_code;
            $order_product->sku = $product->sku;
            $order_product->specification = $product->specification;
            $order_product->price = $order_details->price;
            $order_product->bid_price = $order_details->bid_price;
            $order_product->image = $product->image;
            $order_product->save();
        }
        return true;
    }
    private function createOrderAddress(Request $request, $order)
    {
        $billing_address = $this->createOrderBillingAddress($request, $order);
        $shipping_address = $this->createOrderShippingAddress($request, $order, $billing_address);
        $order->status = 2;
        if ($billing_address && $shipping_address && $order->save()) {
            return true;
        } else {
            return false;
        }
    }
    private function createOrderBillingAddress(Request $request, $order)
    {
        $billing_address = UserAddress::find($request->selected_billing_address);
        if ($billing_address) {
            $order_address = new OrderAddress();
            $order_address->order_id = $order->id;
            $order_address->type = 1;
            $order_address->first_name = $billing_address->first_name;
            $order_address->last_name = $billing_address->last_name;
            $order_address->address_one = $billing_address->address_one;
            $order_address->address_two = $billing_address->address_two;
            $order_address->email = $billing_address->email;
            $order_address->phone_number = $billing_address->phone_number;
            $order_address->city = $billing_address->city;
            $order_address->country_id = $billing_address->country_id;
            $order_address->state_id = $billing_address->state_id;
            $order_address->zip_code = $billing_address->zip_code;
            if ($order_address->save()) {
                return $order_address->id;
            }
        }
    }
    private function createOrderShippingAddress(Request $request, $order, $billing_address)
    {
        if ($billing_address && $request->filled('selected_billing_shipping_same')) {
            $billing_address_data = OrderAddress::find($billing_address);
            $shipping_address = new OrderAddress();
            $shipping_address->order_id = $order->id;
            $shipping_address->type = 2;
            $shipping_address->first_name = $billing_address_data->first_name;
            $shipping_address->last_name = $billing_address_data->last_name;
            $shipping_address->address_one = $billing_address_data->address_one;
            $shipping_address->address_two = $billing_address_data->address_two;
            $shipping_address->email = $billing_address_data->email;
            $shipping_address->phone_number = $billing_address_data->phone_number;
            $shipping_address->city = $billing_address_data->city;
            $shipping_address->country_id = $billing_address_data->country_id;
            $shipping_address->state_id = $billing_address_data->state_id;
            $shipping_address->zip_code = $billing_address_data->zip_code;
            if ($shipping_address->save()) {
                return $shipping_address->id;
            }
        } else {
            $shipping_address = UserAddress::find($request->selected_shipping_address);
            if ($shipping_address) {
                $order_address = new OrderAddress();
                $order_address->order_id = $order->id;
                $order_address->type = 2;
                $order_address->first_name = $shipping_address->first_name;
                $order_address->last_name = $shipping_address->last_name;
                $order_address->address_one = $shipping_address->address_one;
                $order_address->address_two = $shipping_address->address_two;
                $order_address->email = $shipping_address->email;
                $order_address->phone_number = $shipping_address->phone_number;
                $order_address->city = $shipping_address->city;
                $order_address->country_id = $shipping_address->country_id;
                $order_address->state_id = $shipping_address->state_id;
                $order_address->zip_code = $shipping_address->zip_code;
                if ($order_address->save()) {
                    return $order_address->id;
                }
            }
        }
    }
    //bank transfer
    public function bankTransfer($uid)
    {
        $order = Order::where('uid', $uid)->first();
        if (!$order) {
            return redirect()->route('user.order.failed');
        }
        session()->put('order_uid', $uid);
        return redirect()->route('user.order.success');
    }
    public function orderSuccess()
    {
        $uid = session()->get('order_uid');
        if ($uid && $order = Order::where('uid', $uid)->first()) {
            session()->forget('order_uid');
            $order->payment_gateway_status = 1;
            $order->order_status_id = 1;//pending approval from admin
            $order->status = 3;
            if ($order->save()) {
                $order->orderDetails()->update(['order_status_id' => 1]);
                $quotation = Quotation::where('uid', $uid)->first();
                $quotation->status = 5;
                $quotation->save();
                $quotation->acceptedQuotationDetails()->update(['status' => 5]);
                $site_settings = SiteCommonContent::first();

                Mail::to($order->user->email)->send(new OrderCompletedUser($order, $site_settings));
                Mail::to($site_settings->enquiry_receive_email)->send(new OrderCompletedAdmin($order, $site_settings));
            }
            return view('frontend::checkout.order_success', compact('order'));
        } else {
            return redirect()->route('home');
        }
    }
    /**
     * Displays order failed page.
     *
     * @author Suchith
     */
    public function orderFailed()
    {
        $uid = session()->get('order_uid');
        if ($uid && $order = Order::where('uid', $uid)->first()) {
            session()->forget('order_uid');
            $this->forgetCoupon();
            $order->payment_gateway_status = 2;
            $order->status = 4;
            $order->save();
            return view('frontend::checkout.order_failed');
        } else {
            return redirect()->route('home');
        }
    }
    //return the address data for edit
    public function  getAddressData(Request $request)
    {
        $address = UserAddress::where('id', $request->id)
            ->where('user_id', Auth::guard('web')->id())
            ->first();
        if (!$address)
            return response()->json([
                'status' => false
            ]);
        $countries = Country::all();
        if ($request->type == 1)
            $address = View::make('frontend::includes.billing-address-form', compact('address', 'countries'))->render();
        else
            $address = View::make('frontend::includes.shipping-address-form', compact('address', 'countries'))->render();
        return response()->json([
            'status' => true,
            'address' => $address
        ]);
    }
    //check tax for the selected shipping address
    public function checkTaXApplicableForAddress(Request $request)
    {
        $total_tax_amount = $converted_total_tax_amount = 0;
        $site_settings = TaxManagement::first();
        $shipping_address = UserAddress::find($request->address_id);
        $quotation = Quotation::where('uid', $request->quotation_uid)
            ->where('user_id', Auth::guard('web')->id())
            ->first();
        if (!$quotation || $quotation->quotationDetails->whereIn('status', [0, 1])->count() > 1 || $quotation->acceptedQuotationDetails->count() < 1)
            return response()->json([
                'status' => false
            ]);
        $converted_total_amount = $quotation->converted_total_bid_price;
        if ($shipping_address && $shipping_address->state->free_zone == 1) {
            if ($site_settings->tax_percentage) {
                $total_tax_amount += (($quotation->total_bid_price * $site_settings->tax_percentage) / 100);
                $converted_total_tax_amount += $total_tax_amount * $quotation->currency_rate;
            }
            if ($site_settings->tax_amount) {
                $total_tax_amount += $site_settings->tax_amount;
                $converted_total_tax_amount += $site_settings->tax_amount * $quotation->currency_rate;
            }
            $total_amount = $quotation->total_bid_price + $total_tax_amount;
            $converted_total_amount = $quotation->converted_total_bid_price + $converted_total_tax_amount;
            return response()->json([
                'status' => true,
                'tax' => $site_settings,
                'converted_tax_value' => $quotation->priceWithSymbol($site_settings->tax_amount *  $quotation->currency_rate),
                'total_tax_amount' => $total_tax_amount,
                'converted_total_tax_amount' => $quotation->priceWithSymbol($converted_total_tax_amount),
                'total_amount' => $total_amount,
                'converted_total_amount' => $quotation->priceWithSymbol($converted_total_amount)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'converted_total_amount' => $quotation->priceWithSymbol($converted_total_amount)
            ]);
        }
    }
}
