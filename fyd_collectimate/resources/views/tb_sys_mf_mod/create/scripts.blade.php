<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    @select2js([
        'model_path' => 'App\Models\tb_sys_mf_mod_group',
        'column' => 'mod_group_id',
        'placeholder' => 'Select the mod group',
    ]) @endselect2js()
</script>
