@hidden([
'name' => 'id',
])@endhidden()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('code'),
'placeholder' => 'Enter your code',
])@endtext

@select([
'name' => 'client_id',
'label' => 'Client',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $clients,
'value' => old('client_id'),
])@endselect()

@select([
'name' => 'device_id',
'label' => 'Device',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $client_devices,
'value' => old('device_id'),
])@endselect()

@datefield([
'name' => 'cache_expiration_date',
'label' => 'Exp Date',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('cache_expiration_date'),
])@enddatefield()

@select([
'name' => 'cache_license_type_id',
'label' => 'License Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $license_types,
'value' => old('cache_license_type_id'),
])@endselect()

@text([
'name' => 'cache_no_of_license',
'label' => 'No. of License',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('cache_no_of_license'),
'placeholder' => 'Enter the No. of License',
'type' => 'number',
])@endtext()
