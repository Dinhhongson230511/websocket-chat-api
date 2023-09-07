<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FuriganaAndSpecialCharacterRule;

class UpdateAccountRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static function rules()
    {
        return [
            'avatar' => 'nullable|mimes:jpg,jpeg,png,webp|dimensions:min_width:50,min_height:50,max_width:10000,max_height:10000|min:1|max:102400',
            'last_name' => 'required|max_characters:255',
            'first_name' => 'required|max_characters:255',
            'furigana_last_name' => ['required', 'max_characters:255', new FuriganaAndSpecialCharacterRule()],
            'furigana_first_name' => ['required', 'max_characters:255', new FuriganaAndSpecialCharacterRule()],
            'tel' => 'nullable|min:9|max:16|regex:' . config('regex.number'),
            'fax' => 'nullable|min:9|max:16|regex:' . config('regex.number')
        ];
    }

    public static function attributes()
    {
        return [
            'last_name' => __('attribute.manager_last_name'),
            'first_name' => __('attribute.manager_first_name'),
            'furigana_last_name' => __('attribute.manager_furigana_last_name'),
            'furigana_first_name' => __('attribute.manager_furigana_first_name'),
            'email' => __('attribute.email'),
            'tel' => __('attribute.agencies_travel_tel'),
            'fax' => __('attribute.agencies_travel_fax'),
        ];
    }

    public static function messages()
    {
        return [
            'tel.regex' => __('validation.regex_number'),
            'fax.regex' => __('validation.regex_number'),
            'furigana_last_name.regex' => __('validation.regex_furigana'),
            'furigana_first_name.regex' => __('validation.regex_furigana'),
            'tel.min' => __('validation.custom_numeric.min', [
                'attribute' => __('attribute.agencies_travel_tel'),
                'min' => '9'
            ]),
            'fax.min' => __('validation.custom_numeric.min', [
                'attribute' => __('attribute.agencies_travel_fax'),
                'min' => '9'
            ])
        ];
    }
}
