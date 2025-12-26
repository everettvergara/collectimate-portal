@if (($disabled ?? '0') === '0')
<div class="form-check">
    <input type="hidden" name="{{ $name }}" value="0" {{ (isset($form)) ? "form=$form":"" }} />
    <input class="form-check-input {{ $name }} {{ $input_class ?? '' }}" type="checkbox" value="1" id="{{ $name }}" name="{{ $name }}"  {{ ($value??0) == 1 ? "checked":""}} {{ (isset($form)) ? "form=$form":"" }}>
    <label class="form-check-label {{ $label_class ?? '' }}" for="{{ $name }}" {{ (isset($form)) ? "form=$form":"" }}>
        {{ $label ?? strtoupper(str_replace('_', ' ', str_replace('_id', '',$name))) }}
    </label>
</div>
@else
<div class="form-check">
    <input type="hidden" name="{{ $name }}" value="{{$value??0}}" {{ (isset($form)) ? "form=$form":"" }} />
    <input class="form-check-input {{ $name }} {{ $input_class ?? '' }}" type="checkbox" value="1" id="{{ $name }}" name="{{ $name }}"  {{ ($value??0) == 1 ? "checked":""}} {{ (isset($form)) ? "form=$form":"" }} disabled>
    <label class="form-check-label {{ $label_class ?? '' }}" for="{{ $name }}" {{ (isset($form)) ? "form=$form":"" }}>
        {{ $label ?? strtoupper(str_replace('_', ' ', str_replace('_id', '',$name))) }}
    </label>
</div>
@endif
