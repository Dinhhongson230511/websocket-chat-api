<?php

namespace App\Http\Requests\Api\Account;

use App\Rules\FuriganaAndSpecialCharacterRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
    public function rules()
    {
        return [
            'avatar' => 'nullable|mimes:jpg,jpeg,png,webp|dimensions:min_width:50,min_height:50,max_width:10000,max_height:10000|min:1|max:102400',
            'last_name' => 'required|max_characters:255',
            'first_name' => 'required|max_characters:255',
            'furigana_last_name' => ['required', 'max_characters:255', new FuriganaAndSpecialCharacterRule()],
            'furigana_first_name' => ['required', 'max_characters:255', new FuriganaAndSpecialCharacterRule()],
            'email' => 'required|email:rfc,dns|max:60|unique:users,email,' . $this->id . ',id',
            'tel' => 'nullable|min:9|max:16|regex:' . config('regex.number'),
            'fax' => 'nullable|min:9|max:16|regex:' . config('regex.number')
        ];
    }

    public function attributes()
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

    public function messages()
    {
        return [
            'tel.regex' => __('validation.regex_number'),
            'fax.regex' => __('validation.regex_number'),
            'furigana_last_name.regex' => __('validation.regex_furigana'),
            'furigana_first_name.regex' => __('validation.regex_furigana'),
        ];
    }
}
