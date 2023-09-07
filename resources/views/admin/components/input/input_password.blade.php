<div class="input_password">
    <label for="{{ $inputId ?? '' }}">
        {{ $label ?? '' }}             
        @if (isset($requiredLabel) && $requiredLabel)
            <span class="required-text">*</span>
        @endif
        </label>
    <div class="input_password--content">
        <img src="{{ asset('assets/images/icon/block.svg') }}" alt="email" >
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
        <img class="eyes_password @error($inputName ?? '') error_password @enderror " src="{{ asset('assets/images/icon/close_eye.svg') }}" alt="close eyes">
    </div>
</div>
