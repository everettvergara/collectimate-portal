<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_sys_mf_access_type',
        'column' => 'access_type_id',
        'placeholder' => 'Select the type of contact'
    ]) @endselect2js()
</script>
