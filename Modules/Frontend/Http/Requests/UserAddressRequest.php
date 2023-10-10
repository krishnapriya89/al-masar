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
            'address_one'=>'required',
            'city'       => 'required',
            'email'       => 'required|email|max:255',
            'phone_number' => 'required',
            'country'    =>'required',
            'zip_code'   => 'required',
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
}
