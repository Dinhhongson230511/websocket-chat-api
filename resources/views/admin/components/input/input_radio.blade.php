<div class="content_input_radio {{ $classContent ?? '' }}">
    <div class="input_radio">
        <div class="form-check">
            <input
                id="{{ $inputId ?? '' }}"
                class="form-check-input"
                type="radio" name="{{ $inputName ?? '' }}"
                value="{{ $value ?? '' }}"
                @disabled(isset($disabled) && $disabled)
                @if ((isset($checked) && $checked) || (isset($oldValueChecked) && $oldValueChecked))
                    checked
                @endif
            >
            <label class="form-check-label" for="{{ $inputId ?? '' }}" role="button">
                {{ $inputLabel ?? '' }}
            </label>
        </div>
    </div>
</div>
