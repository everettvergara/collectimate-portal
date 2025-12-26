@if (($disabled ?? null) === null)
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        <label for="{{ $name }}" class="form-label  {{ $label_class ?? '' }}">{{ $label ?? strtoupper(str_replace('_', ' ', $name)) }}</label>

        <div class="input-group">
        <input type="password" name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }} {{ $input_class ?? '' }} @error($name) is-invalid @enderror" placeholder="{{ $placeholder ?? null }}" value="{{ $value ?? old($name) }}" >
        @if(($is_toggle ?? 0) === 1)
        <span class="input-group-text {{ $input_class ?? '' }}"><i class="fa fa-eye" id="toggle{{ ucfirst($name) }}" style="cursor: pointer"></i></span>
        @endif()
        </div>
    </div>
@else
    <div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
        <label for="{{ $label ?? $name }}" class="form-label  {{ $label_class ?? '' }}">{{ strtoupper(str_replace('_', ' ', $name)) }}</label>
        <input type="password" name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }} {{ $input_class ?? '' }}" value="{{ $value ?? old($name) }}" style="background-color: #e9ecef;" readonly>
    </div>
@endif
