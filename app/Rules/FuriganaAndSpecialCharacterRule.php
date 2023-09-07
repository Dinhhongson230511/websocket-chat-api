<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class FuriganaAndSpecialCharacterRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[^\x{3040}-\x{309F}\x{4E00}-\x{9FFF}\x{FF01}-\x{FF5E}\x{FF10}-\x{FF19}\x{FF3B}-\x{FF40}\x{FF5B}-\x{FF9F}]+$/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.regex_furigana');
    }
}
