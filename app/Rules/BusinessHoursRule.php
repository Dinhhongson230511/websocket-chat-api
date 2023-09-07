<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BusinessHoursRule implements Rule
{
    public function passes($attribute, $value)
    {
        $sortedBusinessHours = collect($value)->sortBy('start_time');
        $previousEndTime = null;

        foreach ($sortedBusinessHours as $businessHour) {
            $currentStartTime = strtotime($businessHour['start_time']);
            $currentEndTime = strtotime($businessHour['end_time']);

            if ($currentStartTime >= $currentEndTime) {
                return false;
            }

            if ($previousEndTime !== null && $currentStartTime < $previousEndTime) {
                return false;
            }

            $previousEndTime = $currentEndTime;
        }

        return true;
    }

    public function message()
    {
        return __('validation.invalid_hours');
    }
}
