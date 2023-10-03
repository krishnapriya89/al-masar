<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:3',
            'category' => 'required',
            'sub_category' => 'required',
            // 'sub_category_child' => 'required',
            'sku' => 'required|unique:products,sku,NULL,id,deleted_at,NULL',
            'product_code' => 'required|unique:products,product_code,NULL,id,deleted_at,NULL',
            'model_number' => 'required',
            'base_price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:1,2',
            'discount'      => [
                'nullable', 'numeric', 'min:0',
                function ($attribute, $value, $fail) {
                    $basePrice    = request('base_price');
                    $discountType = request('discount_type');
                    if ($discountType == 1 && $value >= $basePrice) {
                        $fail("The $attribute must be less than the $basePrice.");
                    } elseif ($discountType == 2 && ($value <= 0 || $value >= 100)) {
                        $fail("The $attribute must be between 0 and 100 when discount type is percentage.");
                    }
                },
            ],
            'stock' => 'required|integer|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'min_quantity_to_buy' => 'required|integer|min:1',
            'detail_page_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=1080,min_height=1080,max_width=1080,max_height=1080',
            'sort_order' => 'nullable|integer|min:0',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            // $rules['title'] = 'required|min:3|' . Rule::unique('products')->whereNull('deleted_at')->ignore($this->product);
            $rules['sku'] =  'required|' . Rule::unique('products')->whereNull('deleted_at')->ignore($this->product);
            $rules['product_code'] = 'required|' . Rule::unique('products')->whereNull('deleted_at')->ignore($this->product);
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
