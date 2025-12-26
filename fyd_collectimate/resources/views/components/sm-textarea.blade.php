@if (($disabled ?? null) === null)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        <div class="input-group input-group-sm">
            <span class="input-group-text {{ $label_class ?? '' }}" id="inputGroup-sizing-sm-{{ $name }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</span>
            <textarea class="form-control {{ $name }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? null }}">{{ $value ?? old($name) }}</textarea>
        </div>
    </div>
@else
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div class="input-group input-group-sm">
        <span class="input-group-text {{ $label_class ?? '' }}" id="inputGroup-sizing-sm-{{ $name }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</span>
        <textarea class="form-control {{ $name }}" style="background-color: #e9ecef;" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? null }}" readonly>{{ $value ?? old($name) }}</textarea>
   </div>
</div>
@endif
