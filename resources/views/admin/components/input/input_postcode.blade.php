<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label ?? '' }}</p>
        @if (isset($requiredLabel) && $requiredLabel)
            <div class="required-text">*</div>
        @endif
    </div>
    <div class="{{ $postCodeClass['parent'] ?? '' }}">
        <input type="{{ $inputType ?? 'text' }}" id="{{ $id ?? '' }}"
            class="form-control @error($inputName ?? '') is-invalid @enderror {{ $inputClass ?? '' }}"
            @if (isset($inputName) && $inputName) name="{{ $inputName }}" @endif
            @if (isset($placeholder) && $placeholder) placeholder="{{ $placeholder }}" @endif value="{{ $inputValue ?? '' }}"
            @if (isset($inputMaxLength) && $inputMaxLength) maxlength="{{ $inputMaxLength }}" @endif @required(isset($required) && $required)
            @disabled(isset($disabled) && $disabled)>
        @if(!isset($disabled) || !$disabled)
            <label class="{{ $postCodeClass['label'] ?? '' }}" id="{{ $btnId ?? '' }}">{{ $btnLabel ?? '' }}</label>
        @endif
    </div>
    @error($inputName ?? '')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
