<div class="row">
    <div class="{{ $class['parentCol'] }}">
        <label for="">{{ $label['title'] ?? '' }}</label>
        <div class="row">
            <div class="{{ $class['child_col_first'] ?? '' }}">
                <div class="form-check">
                    @if (isset($class['child_col_first']) && $class['child_col_first'])
                        <input class="form-check-input" type="radio" name="{{ $name ?? '' }}" value="{{ $yes ?? '' }}" id="flexRadioDefault1">
                    @endif
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $label['child-title-first'] ?? '' }}
                    </label>
                </div>
            </div>
            <div class="{{ $class['child_col_second'] ?? '' }}">
                <div class="form-check">
                    @if (isset($class['child_col_second']) && $class['child_col_second'])
                        <input class="form-check-input" type="radio" name="{{ $name ?? '' }}" value="{{ $no ?? '' }}" id="flexRadioDefault1">
                    @endif
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $label['child-title-second'] ?? '' }}
                    </label>
                </div>
            </div>
            <div class="{{ $class['child_col_third'] ?? '' }}">
                <div class="form-check">
                    @if (isset($class['child_col_third']) && $class['child_col_third'])
                        <input class="form-check-input" type="radio" name="{{ $name ?? '' }}" value="{{ $other ?? '' }}" id="flexRadioDefault1">
                    @endif
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $label['child-title-third'] ?? '' }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
