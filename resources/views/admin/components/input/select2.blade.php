@props([
    'displaySelectedFirstItem' => true,
    'boxSelectId' => '',
    'containerSelected' => '',
    'lang' => false
])
<div class="my-2 {{ $containerSelected }}" id="{{ $boxSelectId }}">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label ?? '' }}</p>
        @if (isset($requiredLabel) && $requiredLabel)
            <div class="required-text">*</div>
        @endif
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <select
            class="form-select select2 {{ $selectClass ?? '' }}"
            id="{{ $selectId ?? '' }}"
            @if (isset($selectName) && $selectName) name="{{ $selectName }}" @endif
            @if (isset($placeholder) && $placeholder) placeholder="{{ $placeholder }}" @endif
            @required(isset($required) && $required)
            @disabled(isset($disabled) && $disabled)
        >
            @if($displaySelectedFirstItem)
            <option value="" class="fst-italic">{{ $optionNameDefault ?? '' }}</option>
            @endif
            @if (isset($options) && $options)
                @foreach ($options as $value => $option)
                    @if(is_array($option))
                        <option value="{{ $option['value'] }}" {{ isSelectedOption($option['value'], $selectValue) }}>
                            {{ $lang ? __('admin/'.$option['name']) : $option['name'] }}
                        </option>
                    @else
                        <option value="{{ $value }}" {{ isSelectedOption($value, $selectValue) }}>{{ $option }}</option>
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
