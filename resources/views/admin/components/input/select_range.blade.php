@props([
    'label' => '',
    'options' => [],
    'selectedStart' => '',
    'selectedEnd' => '',
])

<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label }}</p>
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <div class="input-group">
            <select class="form-select" id="startDay" name="startDay">
                @foreach ($options as $value => $text)
                    <option value="{{ $value }}" @if ($value == $selectedStart) selected @endif>{{ $text }}</option>
                @endforeach
            </select>
            <span class="input-group-text">~</span>
            <select class="form-select" id="endDay" name="endDay">
                @foreach ($options as $value => $text)
                    <option value="{{ $value }}" @if ($value == $selectedEnd) selected @endif>{{ $text }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
