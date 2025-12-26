@hidden([
'name' => 'id',
'label' => 'ID',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('id'),
])@endhidden()

@hidden([
'name' => 'user_id',
'label' => 'User ID',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => $user_id,
])@endhidden()

@select([
'name' => 'access_type_id',
'label' => 'Access Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $access_types,
'value' => old('access_type_id'),
])@endselect()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('remarks'),
'placeholder' => 'Enter the remarks',
])@endtextarea()
