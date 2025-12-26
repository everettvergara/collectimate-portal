@text([
'name' => 'name',
'placeholder' => 'Enter the Name',
'value' => $name,
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'label_hidden' => 1,
])@endtext()

@select([
'name' => 'city_id',
'elements' => $cities,
'value' => old('city_id') ?? $city_id,
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'placeholder' => 'Enter the City',
'label_hidden' => 1,
])@endselect()
