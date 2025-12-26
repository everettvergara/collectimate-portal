@if (($disabled ?? null) === null)
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    @if (($label_hidden ?? 0) == 0)
        <label for={{ $name }} class="form-label {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name)}}</label>
    @endif
    <div class="input-group ">
        <input type="file" class="form-control {{ $name }} @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" aria-label="{{ $name }}" {{ (($is_multiple ?? 0) == 1 ? "multiple":"")  }}>
        @if(isset($value) && isset($path) && (($is_multiple ?? 0) == 0))
        {{-- <button class="btn btn-info" type="button" id="{{ $name }}_dowload" onclick="window.open('{{ asset('storage/'.$path.'/'.$value) }}')"><i class="fas fa-download"></i></button> --}}
        <a href="{{ asset('storage/'.$path.'/'.$value) }}" class="btn btn-success" id="{{ $name }}_dowload" target="_blank" download><i class="fas fa-download text-light"></i></a>
        <small class="w-100 text-secondary">{{ $value }}</small>
        @endif
    </div>
</div>

@else
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    @if (($label_hidden ?? 0) == 0)
        <label for={{ $name }} class="form-label {{ $label_class ?? '' }}">{{ $label ?? str_replace('_', ' ', $name)}}</label>
    @endif
    <div class="input-group ">
        <input type="file" class="form-control pe-none {{ $name }}" id="{{ $name }}" name="{{ $name }}" aria-label="{{ $name }}" style="background-color: #f3f5f7;" disabled>
        @if(isset($value) && isset($path) && (($is_multiple ?? 0) == 0))
        {{-- <button class="btn btn-info" type="button" id="{{ $name }}_dowload" onclick="window.open('{{ asset('storage/'.$path.'/'.$value) }}')"><i class="fas fa-download"></i></button> --}}
        <a href="{{ asset('storage/'.$path.'/'.$value) }}" class="btn btn-success" id="{{ $name }}_dowload" target="_blank" download><i class="fas fa-download text-light"></i></a>
        <small class="w-100 text-secondary">{{ $value }}</small>
        @endif
    </div>
</div>
@endif

{{-- IF $is_multiple = 0, create a rowmanager to view submitted attachments --}}
