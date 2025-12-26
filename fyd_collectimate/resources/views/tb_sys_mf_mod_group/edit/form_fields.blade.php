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
    'value' => old('code') ?? $datum->code,
    'placeholder' => 'Enter your code'
])@endtext

@text([
    'name' => 'name',
    'label' => 'Name',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('name') ?? $datum->name,
    'placeholder' => 'Enter your name'
])@endtext

@select([
    'name' => 'parent_mod_group_id',
    'label' => 'Parent MOD Group',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'elements' => $parent_mod_groups,
    'value' => old('parent_mod_group_id') ?? $datum->parent_mod_group_id,
])@endselect()

@text([
    'name' => 'seq',
    'label' => 'Sequence',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('seq') ?? $datum->seq,
    'placeholder' => 'Enter your name'
])@endtext

@textarea([
    'name' => 'remarks',
    'label' => 'Remarks',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('remarks') ?? $datum->remarks,
    'placeholder' => 'Enter the remarks',
])@endtextarea()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? $datum->is_active,
    ])@endcheckbox()
</div>
