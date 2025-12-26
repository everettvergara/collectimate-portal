@if (($disabled ?? '0') === '0')
    const {{$name}} = new tempusDominus.TempusDominus(document.getElementById('{{$name}}'), {
        localization: {
            format: 'yyyy-MM-dd H:mm'
          },
        display: {
            theme: 'light'
        }
    });
    {{-- const {{$name}}_tgl = document.getElementById("{{$name}}_tgl");
    {{$name}}_tgl.addEventListener("click", fn_{{$name}}_tgl);

    function fn_{{$name}}_tgl() {
            {{$name}}.show();
    } --}}
@else
    const {{$name}} = new tempusDominus.TempusDominus(document.getElementById('{{$name}}'), {
    });
    {{$name}}.disable();
@endif
