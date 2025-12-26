@if (($disabled ?? 0) === 0)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for={{ $name }}
                class="form-label {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <textarea class="form-control {{ $input_class ?? '' }} {{ $name }} @error($name) is-invalid @enderror"
            id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? null }}" rows="{{ $rows ?? 3 }}">{{ $value ?? old($name) }}</textarea>
    </div>
@else
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for={{ $name }}
                class="form-label input-disable {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name) }}</label>
        @endif
        <textarea class="form-control pe-none {{ $input_class ?? '' }} {{ $name }}" id="{{ $name }}"
            name="{{ $name }}" placeholder="{{ $placeholder ?? null }}" rows="{{ $rows ?? 3 }}" readonly>{{ $value ?? old($name) }}</textarea>
    </div>
@endif
