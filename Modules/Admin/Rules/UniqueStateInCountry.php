<?php

namespace Modules\Admin\Rules;

use App\Models\State;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class UniqueStateInCountry implements Rule
{

    protected $countryId;
    protected $excludeStateId;

    public function __construct($countryId, $excludeStateId = null)
    {
        $this->countryId = $countryId;
        $this->excludeStateId = $excludeStateId;
    }

    public function passes($attribute, $value)
    {
        // Check if the state is unique within the specified country,
        // excluding the current state when updating
        $query = State::where('country_id', $this->countryId)
            ->where('title', $value);

        if ($this->excludeStateId !== null) {
            $query->where('id', '!=', $this->excludeStateId);
        }

        return !$query->exists();
    }

    public function message()
    {
        return 'The state must be unique within the selected country.';
    }
}
