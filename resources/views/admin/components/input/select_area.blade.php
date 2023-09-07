<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label ?? '' }}</p>
        @if (isset($requiredLabel) && $requiredLabel)
            <div class="required-text">*</div>
        @endif
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <select class="form-select {{ $selectClass ?? '' }}" id="{{ $selectId ?? '' }}"
            @if (isset($selectName) && $selectName) name="{{ $selectName }}" @endif
            @if (isset($placeholder) && $placeholder) placeholder="{{ $placeholder }}" @endif @required(isset($required) && $required)
            @disabled(isset($disabled) && $disabled)>
            <option value="" class="fst-italic">{{ $label ?? '' }}</option>
            @if (isset($options) && $options)
                @foreach ($options as $value => $option)
                    @if (isset($hasPrefectureId) && $hasPrefectureId)
                        <option value="{{ $option->id }}" @if (isset($selectValue) && $option->id == $selectValue) selected @endif
                            data-prefecture-id="{{ $option->prefecture?->id }}" class="d-none">
                            {{ $option->name }}
                        </option>
                    @elseif (isset($hasAreaId) && $hasAreaId)
                        <option value="{{ $option->id }}" @if (isset($selectValue) && $option->id == $selectValue) selected @endif
                            data-area-id="{{ $option->area?->id }}" class="d-none">
                            {{ $option->name }}
                        </option>
                    @else
                        <option value="{{ $option->id }}" @if (isset($selectValue) && $option->id == $selectValue) selected @endif>
                            {{ $option->name }}
                        </option>
                    @endif
                @endforeach
            @endif
        </select>
        @error($selectName ?? '')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
