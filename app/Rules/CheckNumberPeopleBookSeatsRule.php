<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNumberPeopleBookSeatsRule implements Rule
{
    protected $dataRequest;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($dataRequest)
    {
        $this->dataRequest = $dataRequest;
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
        $totalNumber = $this->dataRequest->number_of_adults + $this->dataRequest->number_of_children + $this->dataRequest->number_of_infants;

        $total = array_reduce($value, function ($carry, $item) {
            $numberPeople = intval($item['number_people']);
            $numberGroup = intval($item['number_group']);

            if (is_numeric($numberPeople) && is_numeric($numberGroup)) {
                $carry += $numberPeople * $numberGroup;
            }

            return $carry;
        }, 0);

        return ($total <= $totalNumber);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.seats_total_people');
    }
}
