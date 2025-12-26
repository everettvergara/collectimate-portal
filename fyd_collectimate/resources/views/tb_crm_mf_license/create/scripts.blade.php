<script nonce="{{ $cspNonce }}">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
        var client_id = document.getElementById("client_id");
        $('.device_id').select2({
            placeholder: 'All Devices',
            theme: 'bootstrap-5',
            allowClear: true,
            ajax: {
                type: 'POST',
                url: "{{ route('select2.devices') }}",
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        province_id: province_id.value,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
