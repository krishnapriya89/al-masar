<?php

namespace Modules\Frontend\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Rules\UniquePhoneInUsersTable;

class UserProfileUpdateRequest extends FormRequest
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
            'company' => 'required|max:255',
            'address' => 'required',
            'country' => 'required',
            'email' => [
                    'required', 'email', 'max:255',
                    Rule::unique('users')->whereNull('deleted_at')->ignore($this->user()->id)
            ],
            'phone' => [
                'required',
                new UniquePhoneInUsersTable,
                'regex:/^\+?[0-9]{1,4}[-\s]?[0-9]{6,14}$/'
            ],
            'office_phone' => [
                'required',
                new UniquePhoneInUsersTable,
                'regex:/^\+?[0-9]{1,4}[-\s]?[0-9]{6,14}$/'
            ],
            'attachment' => 'nullable|max:2000|mimes:pdf,jpg,jpeg,png'
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

    public function  messages()
    {
        $messages = [
            'attachment.max' => 'The attachment field must not be greater than 2MB'
        ];

        return $messages;
    }
}
