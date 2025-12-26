@if (($disabled ?? null) === null)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}"
                class="form-label d-flex {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <input type="date" class="form-control {{ $input_class ?? '' }} @error($name) is-invalid @enderror"
            id="{{ $name }}" name="{{ $name }}" value="{{ $value ?? old($name) }}">
        <small class="w-100 text-secondary fs-7">Click the icon for the virtual calendar.</small>
    </div>
@else
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}"
                class="form-label d-flex pe-none {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <input type="date" class="form-control input-disable {{ $input_class ?? '' }}" nonce="{{ csp_nonce() }}"
            id="{{ $name }}" name="{{ $name }}" value="{{ $value ?? old($name) }}" readonly>
    </div>
@endif
