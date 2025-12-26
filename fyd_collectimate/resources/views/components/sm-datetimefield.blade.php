<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div class="input-group input-group-sm">
        <span class="input-group-text {{ $label_class ?? '' }}" id="inputGroup-sizing-sm-{{ $name }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</span>
        <input type="text" id="{{ $name }}" class="form-control {{ $name }}" style="{{ (($disabled ?? '0') === '0') ? '' : 'background-color: #e9ecef;'}}" name="{{$name}}" value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}" {{ (($disabled ?? '0') === '0') ? '' : 'disabled'}}>
        @if (($disabled ?? null) != null)
                <input type="hidden" name="{{ $name }}" value="{{ $value ?? old($name) }}"/>
        @endif
    </div>

</div>

