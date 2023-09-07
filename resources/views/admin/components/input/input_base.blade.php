<div class="my-2">
    @if (isset($label) && $label)
        <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
            <p class="m-0 {{ $labelClass ?? '' }}">{{ $label ?? '' }}</p>
            @if (isset($requiredLabel) && $requiredLabel)
                <div class="required-text">*</div>
            @endif
        </div>
    @endif
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
        'suggestion' => $inputSuggestion ?? false,
        'suggestionClass' => $inputSuggestionClass ?? '',
        'suggestionText' => $inputSuggestionText ?? '',
        'min' => $inputMin ?? ''
    ])
</div>
