<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_crm_mf_client',
        'column' => 'client_id',
        'placeholder' => 'Select the client',
    ]) @endselect2js()
</script>
