@if (($disabled ?? 0) === 0)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}" class="form-label {{ $label_class ?? '' }}"
                id="{{ $name }}_label">{{ $label ?? str_replace('_', ' ', str_replace('_id', '', $name)) }}</label>
        @endif
        <select
            class="form-select input-select-w-100 {{ $input_class ?? '' }} {{ $name }} @error($name) is-invalid @enderror"
            name="{{ $name }}" id="{{ $name }}">
            <option value="{{ null }}">
                {{ $default ?? 'Select the ' . strtoupper(str_replace('_', ' ', str_replace('_id', '', $label ?? $name))) }}
            </option>
            @foreach ($elements as $element)
                <option value="{{ $element->id ?? $element }}"
                    {{ ($value ?? old($name)) == ($element->id ?? $element) ? 'selected' : '' }}>
                    {{ $element->name ?? ucfirst($element) }}</option>
            @endforeach
        </select>
    </div>
@else
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        @if (($label_hidden ?? 0) == 0)
            <label for="{{ $name }}" class="form-label pe-none {{ $label_class ?? '' }}"
                id="{{ $name }}_label">{{ $label ?? str_replace('_', ' ', str_replace('_id', '', $name)) }}</label>
        @endif
        <select class="form-select input-select-w-100 input-disable {{ $input_class ?? '' }} {{ $name }}"
            name="{{ $name }}" id="{{ $name }}" disabled>
            <option value="{{ null }}">
                {{ $default ?? 'Select the ' . strtoupper(str_replace('_', ' ', str_replace('_id', '', $label ?? $name))) }}
            </option>
            @foreach ($elements as $element)
                <option value="{{ $element->id ?? $element }}"
                    {{ ($value ?? old($name)) == ($element->id ?? $element) ? 'selected' : '' }}>
                    {{ $element->name ?? ucfirst($element) }}</option>
            @endforeach
        </select>

        <input type="hidden" id="{{ $name }}" name="{{ $name }}" value={{ $value }}>
    </div>
@endif
