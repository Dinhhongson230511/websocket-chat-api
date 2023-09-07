<?php

namespace App\Http\Requests\Api\Auth;

use App\Rules\CheckOldPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required', 'min:8', 'regex:' . config('regex.password'), new CheckOldPasswordRule()],
            'new_password' => [
                'required',
                'min:8',
                'max:20',
                'regex:' . config('regex.password')
            ],
            'password_confirmed' => 'required|same:new_password',
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => __('attribute.old_password'),
            'new_password' => __('attribute.new_password'),
            'password_confirmed' => __('attribute.password_confirmed'),
        ];
    }

    public function messages()
    {
        return [
            'new_password.regex' => __('validation.change_password.invalid'),
        ];
    }
}
