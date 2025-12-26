@hidden([
'name' => 'id',
'value' => $datum->id,
])@endhidden()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => $datum->code,
'placeholder' => 'Enter your code',
'disabled' => 1,
])@endtext()

@select([
'name' => 'client_id',
'label' => 'Client',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $clients,
'value' => old('client_id') ?? $datum->client_id,
'disabled' => 1,
])@endselect()

@select([
'name' => 'device_id',
'label' => 'Device',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $client_devices,
'value' => old('device_id') ?? $datum->device_id,
'disabled' => 1,
])@endselect()

@datefield([
'name' => 'cache_expiration_date',
'label' => 'Exp Date',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('cache_expiration_date') ?? $datum->cache_expiration_date,
'disabled' => 1,
])@enddatefield()

@select([
'name' => 'cache_license_type_id',
'label' => 'License Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $license_types,
'value' => old('cache_license_type_id') ?? $datum->cache_license_type_id,
'disabled' => 1,
])@endselect()

@text([
'name' => 'cache_no_of_license',
'label' => 'No. of License',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('cache_no_of_license') ?? $datum->cache_no_of_license,
'placeholder' => 'Enter the No. of License',
'type' => 'number',
'disabled' => 1,
])@endtext()
