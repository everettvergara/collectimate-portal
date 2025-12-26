@if(!empty($src))
    <img src="{{ $src }}" alt=""
         class="{{ $class ?? '' }}"
         style="width: {{ $width ?? '100%' }}; height: {{ $height ?? '100%' }}; max-width: {{ $maxWidth ?? '' }}; max-height: {{ $maxHeight ?? '' }}; object-fit: {{ $objectFit ?? 'contain' }}; object-position: {{$objectPosition ?? 'top'}}">
@endif
