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
'placeholder' => 'Enter your code',
'disabled' => 1,
])@endtext()

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('name') ?? $datum->name,
'placeholder' => 'Enter your name',
'disabled' => 1,
])@endtext()

@select([
'name' => 'user_id',
'label' => 'User',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'elements' => $users,
'value' => old('user_id') ?? $datum->user_id,
'disabled' => 1,
])@endselect()

@textarea([
'name' => 'remarks',
'label' => 'Remarks',
'col' => 'col-12 col-md-6 col-lg-4 mb-3',
'input_class' => '',
'value' => old('remarks') ?? $datum->remarks,
'placeholder' => 'Enter your remarks',
'disabled' => 1,
])@endtextarea()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? $datum->is_active,
    'disabled' => 1,
    ])@endcheckbox()
</div>
