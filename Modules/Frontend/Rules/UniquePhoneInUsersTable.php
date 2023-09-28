<?php

namespace Modules\Frontend\Rules;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class UniquePhoneInUsersTable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Retrieve the 'phone' and 'office_phone' columns from the 'users' table
        $existingPhoneNumbers = User::
            where('phone', $value)
            ->orWhere('office_phone', $value)
            ->count();

        return $existingPhoneNumbers === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number already exists in either the phone or office phone column.';
    }
}
