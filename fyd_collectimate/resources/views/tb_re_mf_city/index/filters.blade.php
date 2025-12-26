@text([
'name' => 'name',
'placeholder' => 'Enter the Name',
'value' => $name,
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'label_hidden' => 1,
])@endtext()

@select([
'name' => 'province_id',
'elements' => $provinces,
'value' => old('province_id') ?? $province_id,
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'placeholder' => 'Enter the Province',
'label_hidden' => 1,
])@endselect()
