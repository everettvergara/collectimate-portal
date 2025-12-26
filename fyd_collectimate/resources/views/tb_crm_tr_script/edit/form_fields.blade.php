@hidden([
'name' => 'id',
'value' => $datum->id,
])@endhidden()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('code') ?? $datum->code,
'placeholder' => 'Enter the code',
])@endtext()

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('name') ?? $datum->name,
'placeholder' => 'Enter the name',
])@endtext()

@select([
'name' => 'client_id',
'label' => 'Client',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $clients,
'value' => old('client_id') ?? $datum->client_id,
])@endselect()

@select([
'name' => 'license_type_id',
'label' => 'License Type',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $license_types,
'value' => old('license_type_id') ?? $datum->license_type_id,
])@endselect()

@textarea([
'name' => 'description',
'label' => 'Description',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('description') ?? $datum->description,
'placeholder' => 'Enter the description',
])@endtextarea()

@textarea([
'name' => 'json_file_path',
'label' => 'JSON File Path',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('json_file_path') ?? $datum->json_file_path,
'placeholder' => 'Enter the json file path',
])@endtextarea()
