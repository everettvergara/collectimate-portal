<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_sys_mf_user',
        'column' => 'user_id',
        'placeholder' => 'Select the user',
    ]) @endselect2js()
</script>
