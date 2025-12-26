@hidden([
'name' => 'id',
'value' => old('id')
])@endhidden()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('code'),
'placeholder' => 'Enter the code',
])@endtext()

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('name'),
'placeholder' => 'Enter the name',
])@endtext()

@text([
'name' => 'tin',
'label' => 'TIN',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('tin'),
'placeholder' => 'Enter the TIN',
])@endtext()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('remarks'),
'placeholder' => 'Enter the remarks',
])@endtextarea()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? 1,
    ])@endcheckbox()
</div>
