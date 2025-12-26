<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <label for="{{ $name }}"
        class="form-label {{ $label_class ?? '' }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</label>
    <input type="text" id="{{ $name }}"
        class="form-control input-dt-bg {{ $name }} @error($name) is-invalid @enderror" name="{{ $name }}"
        value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}"
        {{ ($disabled ?? null) === null ? '' : 'disabled' }} autocomplete="off">
    @if (($disabled ?? null) == null)
        <small class="w-100 text-secondary fs-7">Click the field for the virtual calendar/clock.</small>
    @endif
    @if (($disabled ?? null) != null)
        <input type="hidden" name="{{ $name }}" value="{{ $value ?? old($name) }}" />
    @endif
</div>
