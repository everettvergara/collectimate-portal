@if (($disabled ?? null) === null)
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div class="input-group input-group-sm">
        <span class="input-group-text {{ $label_class ?? '' }}" id="inputGroup-sizing-sm-{{ $name }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</span>
        <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }}" value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}" >
    </div>
</div>
@else
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div class="input-group input-group-sm">
        <span class="input-group-text {{ $label_class ?? '' }}" id="inputGroup-sizing-sm-{{ $name }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</span>
        <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" style="background-color: #e9ecef;" class="form-control {{ $name }}" value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}" readonly>
    </div>
</div>
@endif
