<div class="row">
    <div class="col-12 col-lg-4">
        @text([
        'name' => 'id',
        'label' => 'ID',
        'col' => 'col-12 mb-3',
        'input_class' => 'custom-input',
        'value' => $datum->id,
        'disabled' => 1,
        ])@endtext

        @text([
        'name' => 'code',
        'label' => 'Code',
        'col' => 'col-12 mb-3',
        'input_class' => 'custom-input',
        'value' => old('code') ?? $datum->code,
        'placeholder' => 'Enter your code'
        ])@endtext

        @text([
        'name' => 'name',
        'label' => 'Name',
        'col' => 'col-12 mb-3',
        'input_class' => 'custom-input',
        'value' => old('name') ?? $datum->name,
        'placeholder' => 'Enter your name'
        ])@endtext

        @textarea([
        'name' => 'remarks',
        'label' => 'Remarks',
        'col' => 'col-12 mb-3',
        'input_class' => 'custom-input',
        'value' => old('remarks') ?? $datum->remarks,
        'placeholder' => 'Enter the remarks',
        ])@endtextarea()

        <div class="col-lg-4 col-md-6 col-sm-12 my-3">
            @checkbox([
            'name' => 'is_active',
            'label' => 'Is Active',
            'value' => old('is_active') ?? $datum->is_active,
            ])@endcheckbox()
        </div>

    </div>
</div>
