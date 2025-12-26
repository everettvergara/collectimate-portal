@if (($disabled ?? null) === null)
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div>{{ $label ?? ucwords(str_replace('_', ' ', str_replace('_id', '', $name))) }}</div>
    @foreach ($elements as $element)
        <div class="form-check {{$class ?? ''}} ms-1">
            <input class="form-check-input " type="radio" name="{{$name}}" id="{{ $name.$element->id }}" value="{{ $element->id }}" {{ (($value ?? old($name)) == ($element->id ?? $element) ? "checked":"") }}>
            <label class="form-check-label" for="{{ $name.$element->id }}">
                {{ $element->name }}
            </label>
        </div>
    @endforeach
</div>
@else
<div class="{{ $col ?? 'col-lg-4 col-md-6 col-sm-12 mb-3' }}">
    <div>{{ $label ?? ucwords(str_replace('_', ' ', str_replace('_id', '', $name))) }}</div>
    @foreach ($elements as $element)
        <div class="form-check {{$class ?? ''}} ms-1">
            <input class="form-check-input " type="radio" name="{{$name}}" id="{{ $name.$element->id }}" value="{{ $element->id }}" {{ (($value ?? old($name)) == ($element->id ?? $element) ? "checked":"") }} disabled>
            <label class="form-check-label" for="{{ $name.$element->id }}">
                {{ $element->name }}
            </label>
        </div>
    @endforeach
    {{-- <input type="hidden" id="{{ $name }}" name="{{ $name }}" value={{ $value }}> --}}
</div>
@endif
