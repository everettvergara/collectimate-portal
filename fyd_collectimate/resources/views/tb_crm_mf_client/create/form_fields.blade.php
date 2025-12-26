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
'placeholder' => 'Enter your code',
])@endtext()

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('name'),
'placeholder' => 'Enter your name',
])@endtext()

@select([
'name' => 'user_id',
'label' => 'User',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $users,
'value' => old('user_id'),
])@endselect()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
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
