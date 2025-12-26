@hidden([
'name' => 'id',
'label' => 'ID',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('id'),
])@endhidden()

@hidden([
'name' => 'license_id',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => $license_id,
])@endhidden()

@hidden([
'name' => 'device_id',
])@endhidden()

@datefield([
'name' => 'expiration_date',
'label' => 'Exp Date',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('expiration_date'),
])@enddatefield()

@select([
'name' => 'license_type_id',
'label' => 'License Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $license_types,
'value' => old('license_type_id'),
])@endselect()

@text([
'name' => 'no_of_license',
'label' => 'No. of License',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('no_of_license'),
'placeholder' => 'Enter the No. of License',
'type' => 'number',
])@endtext()
