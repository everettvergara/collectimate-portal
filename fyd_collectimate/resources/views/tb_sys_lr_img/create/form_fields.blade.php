@text([
    'name'          => 'id',
    'label' => 'ID',
    'col' => 'col-12 col-lg-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'disabled'      => 1,
])@endtext()

@text([
    'name'          => 'table_name',
    'label'         => 'Table',
    'col' => 'col-12 col-lg-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('table_name') ?? 'tb_sys_lr_img',
    'placeholder'   => 'Enter your table name',
    'disabled'      => 1,
])@endtext()

@text([
    'name'          => 'filename',
    'label' => 'Filename',
    'col' => 'col-12 col-lg-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('filename'),
    'placeholder'   => 'Enter your filename',
    'disabled'      => 1,
])@endtext()

@text([
    'name' => 'path',
    'label' => 'Path',
    'col' => 'col-12 col-lg-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('path') ?? 'Original',
    'placeholder' => 'Enter your path',
    'disabled'      => 1,
])@endtext()

@uploader([
    'name'          => 'image',
    'label'         => 'Image',
    'col' => 'col-12 col-lg-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'is_multiple'   => 0,
])@enduploader()

