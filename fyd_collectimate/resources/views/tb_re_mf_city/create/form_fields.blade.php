@text([
'name' => 'id',
'label' => 'ID',
'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
'input_class' => '',
'disabled' => 1,
])@endtext()

@select([
'name' => 'province_id',
'label' => 'Province',
'elements' => $provinces,
'value' => old('province_id'),
'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
'input_class' => '',
'placeholder' => 'Enter the Province',
'label_hidden' => 0,
])@endselect()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
'input_class' => '',
'value' => old('code'),
'placeholder' => 'Enter your code',
])@endtext()

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
'input_class' => '',
'value' => old('name'),
'placeholder' => 'Enter your name',
])@endtext()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
'input_class' => '',
'value' => old('remarks'),
'placeholder' => 'Enter your remarks',
])@endtextarea()


<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? 1,
    ])@endcheckbox()
</div>
