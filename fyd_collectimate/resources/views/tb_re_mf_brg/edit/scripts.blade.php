<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_re_mf_city',
        'column' => 'city_id',
        'placeholder' => 'Select the city',
    ]) @endselect2js()
</script>
