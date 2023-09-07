<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class CheckCustomerNameUniqueAgency implements Rule
{
    protected $agencyId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($agencyId)
    {
        $this->agencyId = $agencyId;
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
        $customersName = Customer::query()->where('agency_id', $this->agencyId)->pluck('name')->toArray();
        return !in_array($value, $customersName);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.agency_exist');
    }
}
