<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_re_mf_province',
        'column' => 'province_id',
        'placeholder' => 'Select the province',
    ]) @endselect2js()
</script>
