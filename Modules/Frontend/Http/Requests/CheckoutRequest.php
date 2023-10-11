<?php

namespace Modules\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'selected_billing_address' => 'required',
            'selected_shipping_address' => 'required_if:selected_billing_shipping_same,null',
            'selected_payment_method' => 'required',
            'terms_and_condition' => 'required'
        ];

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages() {
        $messages = [
            'selected_billing_address.required' => 'The Billing address field is required',
            'selected_shipping_address' => 'The Shipping address field is required',
            'selected_payment_method' => 'The payment method field is required',
            'terms_and_condition' => 'Please accept Terms and Conditions'
        ];

        return $messages;
    }
}
