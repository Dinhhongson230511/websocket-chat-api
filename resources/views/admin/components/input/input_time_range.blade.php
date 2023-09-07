@props([
    'label' => '',
    'selectedStart' => '',
    'selectedEnd' => '',
])

<div class="my-2">
    <div class="mb-2 d-flex {{ $boxLabelClass ?? '' }}">
        <p class="m-0 {{ $labelClass ?? '' }}">{{ $label }}</p>
    </div>
    <div class="{{ $boxSelectClass ?? '' }}">
        <div class="input-group">
            <span class="position-relative calendar-group">
                <input type="text" class="form-control timepicker" id="{{ $idStart ?? '' }}" name="{{ $nameStart ?? '' }}"
                       value="{{ $valuedStart }}" lang="ja" autocomplete="off">
                <i class="icon cil-clock calendar-time calendar-icon"></i>
            </span>
            <span class="input-group-text">~</span>
            <span class="position-relative calendar-group">
                <input type="text" class="form-control timepicker" id="{{ $idEnd ?? '' }}" name="{{ $nameEnd ?? '' }}"
                       value="{{ $valuedEnd }}" lang="ja" autocomplete="off">
                <i class="icon cil-clock calendar-time calendar-icon"></i>
            </span>
        </div>
        @error($nameStart)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @error($nameEnd)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
