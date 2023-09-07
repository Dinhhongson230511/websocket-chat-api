@props([
    'label' => '',
    'checkBoxValues' => [],
    'checkboxes' => [],
])

<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label }}</p>
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        @if(old('day')) @endif
        @foreach ($checkboxes as $checkbox)
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input"
                    type="checkbox"
                    @disabled(isset($disabled) && $disabled)
                    @if(isset($checkbox->id))
                        id="{{ $checkbox->id }}"
                    @endif
                    name="{{ $name }}"
                    value="{{ $checkbox->value }}"
                    @if (in_array($checkbox->id, $checkBoxValues)) checked @endif
                >
                <label class="form-check-label" for="{{  $checkbox->id }}">{{ $checkbox->label }}</label>
            </div>
        @endforeach
    </div>
</div>
