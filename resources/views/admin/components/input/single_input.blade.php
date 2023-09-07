<input type="{{ $type ?? 'text' }}"
    id="{{ $id ?? '' }}"
    class="form-control @error($name ?? '') is-invalid @enderror {{ $class ?? '' }}"
    @if (isset($name) && $name) name="{{ $name }}" @endif
    @if (isset($placeholder) && $placeholder) placeholder="{{ $placeholder }}" @endif
    value="{{ $value ?? '' }}"
    @if (isset($maxLength) && $maxLength) maxlength="{{ $maxLength }}" @endif
    @required(isset($required) && $required)
    @disabled(isset($disabled) && $disabled)
    min="{{ $min ?? '' }}"
>
@error($name ?? '')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
@if (isset($suggestionText) && $suggestionText)
    <p class="mt-2 {{ $suggestionClass ?? '' }}">{!! $suggestionText !!}</p>
@endif

