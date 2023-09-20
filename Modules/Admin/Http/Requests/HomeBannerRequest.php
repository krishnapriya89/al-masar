<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [

            'image' => 'required|image|mimes:png,jpg,jpeg,webp',
            'sort_order' => 'nullable|integer|min:0'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $rules['image'] = 'nullable|image|mimes:png,jpg,jpeg,webp';
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