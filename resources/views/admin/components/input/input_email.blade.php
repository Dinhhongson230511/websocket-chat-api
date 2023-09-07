<div class="input_email">
    <label for="{{ $inputId ?? '' }}">@lang('auth.login.input.email')</label>
    <div class="input_email--content">
        <img src="{{ asset('assets/images/icon/email.svg') }}" alt="email" >
        @include('admin.components.input.single_input', [
            'type' => $inputType ?? '',
            'id' => $inputId ?? '',
            'class' => $inputClass ?? '',
            'name' => $inputName ?? '',
            'placeholder' => $placeholder ?? '',
            'value' => $inputValue ?? '',
            'maxLength' => $inputMaxLength ?? '',
            'required' => $required ?? false,
            'disabled' => $disabled ?? false,
            'boxClass' => $boxInputClass ?? '',
            'suggestionClass' => $inputSuggestionClass ?? '',
            'suggestionText' => $inputSuggestionText ?? ''
        ])
    </div>
</div>
