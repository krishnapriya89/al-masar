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

            'web_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'mob_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $rules['web_image'] = 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048';
            $rules['mob_image'] = 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048';

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
