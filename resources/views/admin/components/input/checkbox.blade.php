<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label ?? '' }}</p>
        @if (isset($requiredLabel) && $requiredLabel)
            <div class="required-text">*</div>
        @endif
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <div class="form-check">
            <input
                class="form-check-input {{ $checkboxClass ?? '' }}"
                type="checkbox"
                id="{{ $checkboxId ?? '' }}"
                @if (isset($checkboxName) && $checkboxName) name="{{ $checkboxName }}" @endif
                @if (isset($checkboxValue) && $checkboxValue) value="{{ $checkboxValue }}" @endif
                @if (isset($required) && $required) required @endif
                @if (isset($disabled) && $disabled) disabled @endif
                @if (isset($checkboxChecked) && $checkboxChecked) checked @endif
            >
            <label class="form-check-label {{ $checkboxLabelClass ?? '' }} " for="{{ $checkboxId ?? '' }}">
                {{ $checkboxLabel ?? '' }}
            </label>
        </div>
        @error($checkboxName ?? '')
        <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
