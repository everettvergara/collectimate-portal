@if (($disabled ?? 0) === 0)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}"
                class="form-label {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <input type="{{ $type ?? 'text' }}" step="any" name="{{ $name }}" id="{{ $name }}"
            class="form-control {{ $input_class ?? '' }} {{ $name }} @error($name) is-invalid @enderror"
            value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}" step="{{ $step ?? 'any' }}">
    </div>
@else
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}"
                class="form-label {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <input type="{{ $type ?? 'text' }}" step="any" name="{{ $name }}" id="{{ $name }}"
            class="form-control pe-none input-disable {{ $input_class ?? '' }} {{ $name }}"
            value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}" step="{{ $step ?? 'any' }}"
            readonly>
    </div>
@endif
