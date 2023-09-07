<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
        if (!empty($this->images)) {
            return [
                'images.*' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            ];
        }

        if (!empty($this->attachments)) {
            return [
                'attachments.*' => 'required|file|max:10000|mimes:xlsx,xls,csv,bmp,doc,docx,pdf,tif,tiff'
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'images.*.required' => __('validation.required'),
            'images.*.max' => __('validation.invalid_max_file'),
            'images.*.mimes' => __('validation.invalid_type_file'),
            'attachments.*.required' => __('validation.required'),
            'attachments.*.max' => __('validation.invalid_max_file'),
            'attachments.*.mimes' => __('validation.invalid_type_file'),
        ];
    }
}
