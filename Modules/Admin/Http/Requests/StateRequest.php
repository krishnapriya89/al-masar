<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Rules\UniqueStateInCountry;
use Modules\Admin\Rules\UniqueStateInCountry as Enter;
use Modules\Admin\Rules\UniqueStateInCountry as RulesUniqueStateInCountry;

class StateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => [
                'required', 'max:255', new UniqueStateInCountry(base64_decode($this->input('country_id')))
            ],
            'code' => 'required|max:255|unique:states,code,NULL,id,deleted_at,NULL',
            'sort_order' => 'nullable|integer|min:0'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['title'] = [
                'required', 'max:255', new UniqueStateInCountry($this->state->country_id, $this->state->id)
            ];
            $rules['code'] = 'required|max:255|' . Rule::unique('states')->whereNull('deleted_at')->ignore($this->state);
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
