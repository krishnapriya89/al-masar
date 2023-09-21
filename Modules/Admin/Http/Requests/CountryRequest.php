<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255|unique:countries,title,NULL,id,deleted_at,NULL',
            'code' => 'required|max:255|unique:countries,code,NULL,id,deleted_at,NULL',
            'sort_order' => 'nullable|integer|min:0'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['title'] = 'required|max:255|' . Rule::unique('countries')->whereNull('deleted_at')->ignore($this->country);
            $rules['code'] = 'required|max:255|' . Rule::unique('countries')->whereNull('deleted_at')->ignore($this->country);
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
