@text([
    'name' => 'id',
    'label' => 'ID',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => $datum->id,
    'disabled' => 1,
])@endtext

@text([
    'name' => 'code',
    'label' => 'Code',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => $datum->code,
    'placeholder' => 'Enter your code',
    'disabled' => 1,
])@endtext

@text([
    'name' => 'name',
    'label' => 'Name',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => $datum->name,
    'placeholder' => 'Enter your name',
    'disabled' => 1,
])@endtext

@select([
    'name' => 'mod_group_id',
    'label' => 'MOD Group',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'elements' => $mod_groups,
    'value' => old('mod_group_id') ?? $datum->mod_group_id,
    'disabled' => 1,
])@endselect()


@text([
    'name' => 'seq',
    'label' => 'Sequence',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('seq') ?? $datum->seq,
    'placeholder' => 'Enter your Sequence',
    'disabled' => 1,
])@endtext()

@text([
    'name' => 'url',
    'label' => 'URL',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('url') ?? $datum->url,
    'placeholder' => 'Enter your URL',
    'disabled' => 1,
])@endtext()

@textarea([
    'name' => 'remarks',
    'label' => 'Remarks',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('remarks') ?? $datum->remarks,
    'placeholder' => 'Enter the remarks',
    'disabled' => 1,
])@endtextarea()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => $datum->is_active,
    'disabled' => 1,
    ])@endcheckbox()
</div>

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_visible',
    'label' => 'Is Visible',
    'value' => old('is_visible') ?? $datum->is_visible,
    'disabled' => 1,
    ])@endcheckbox()
</div>
