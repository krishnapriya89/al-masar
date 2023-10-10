<?php

namespace Modules\Frontend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required|regex:/^[A-Za-z\s]+$/', 'min:3', 'max:25',
            'last_name'  => 'required|regex:/^[A-Za-z\s]+$/', 'min:3', 'max:25',
            'address_one'=>'required|min:3',
            'city'       => 'required|min:2',
            'email'       => 'required|email|max:255',
            'phone_number' => 'required|regex:/^\+?[0-9]{1,4}[-\s]?[0-9]{6,14}$/',
            'country'    =>'required',
            'zip_code'   => 'required|integer|min_digits:6|max_digits:8',
            'state'      => 'required'
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

    public function messages()
    {
        $messages = [
            'phone_number.regex' => 'The phone number field has invalid data',
        ];

        return $messages;
    }
}
