@hidden([
'name' => 'id',
'label' => 'ID',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => $datum->id,

])@endhidden()

@hidden([
'name' => 'mod_id',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => $datum->mod_id,
])@endhidden()

@select([
'name' => 'access_type_id',
'label' => 'Access Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $access_types,
'value' => old('access_type_id') ?? $datum->access_type_id,
'disabled' => 1,
])@endselect()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('remarks') ?? $datum->remarks,
'placeholder' => 'Enter the remarks',
'disabled' => 1,
])@endtextarea()
