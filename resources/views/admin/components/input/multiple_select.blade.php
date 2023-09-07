@props([
    'label' => '',
    'requiredLabel' => false,
    'options' => [],
    'optionGroups' => [],
    'selectedValues' => [],
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'multiple' => false,
    'maximumSelectionLength' => 0,
])
<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label }}</p>
        @if ($requiredLabel)
            <div class="required-text">*</div>
        @endif
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <select class="form-select select2-multiple {{ $selectClass ?? '' }}"
            {{ $attributes->merge(['id' => $selectId, 'name' => $multiple ? $selectName . '[]' : $selectName]) }}
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($required) required @endif @if ($disabled) disabled @endif
            @if ($multiple) multiple @endif
            data-maximum-selection-length="{{ $maximumSelectionLength }}">
            @if ($placeholder)
                <option value="" class="fst-italic">{{ $placeholder }}</option>
            @endif
            @foreach ($options as $option)
                <option value="{{ $option->id }}" @if (in_array($option->id, $selectedValues)) selected @endif>
                    {{ $option->name }}</option>
            @endforeach
            @foreach ($optionGroups as $groupLabel => $groupData)
                @if (is_array($groupData))
                    <optgroup label="{{ $groupLabel }}">
                        @foreach ($groupData as $option)
                            <option value="{{ $option->id }}" @if (in_array($option->id, $selectedValues)) selected @endif>
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endif
            @endforeach
        </select>
        @error($selectName)
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@push('js')
    <script>
        const onlySelectionThreeItem = `{{ __('admin/store.message.only_select_3_items')}}`;
        $(document).ready(function() {
            $('.select2-multiple').select2({
                closeOnSelect: false,
                language: {
                    maximumSelected: function() {
                        return onlySelectionThreeItem;
                    },
                },
            });
        });
    </script>
@endpush
