<div class="row">
    <div class="{{ $class ?? '' }} select2_content">
        <label for="">{{ $label ?? '' }}</label>
        <select class="form-control select2" multiple="multiple" name="{{ $name ?? '' }}"  
            @disabled(isset($disabled) && $disabled)
        >
            @if (isset($options) && $options)
                @foreach ($options as $option)
                    <option
                        value="{{ $option->id }}"
                        {{ old(str_replace('[]', '', $name), $valueSelect ?? []) && in_array($option->id, old(str_replace('[]', '', $name), $valueSelect ?? [])) ? 'selected' : '' }}
                    >
                        {{ $option->name }}
                    </option>
                @endforeach
            @endif
        </select>
        <img src="{{ asset('assets/images/icon/Vector.svg') }}" alt="vector" class="arrow-down">
    </div>
</div>
