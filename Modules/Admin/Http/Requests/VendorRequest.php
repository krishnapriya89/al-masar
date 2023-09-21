<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:vendors,email,NULL,id,deleted_at,NULL',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['email'] = 'required|max:255|' . Rule::unique('vendors')->whereNull('deleted_at')->ignore($this->vendor);
        }

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
