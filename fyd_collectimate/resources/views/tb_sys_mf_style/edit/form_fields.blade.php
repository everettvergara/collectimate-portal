
@text([
    'name'          => 'id',
    'label'          => 'ID',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => $datum->id,
    'disabled'      => 1,
])@endtext()

@text([
    'name'          => 'code',
    'label'          => 'Code',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('code') ?? $datum->code,
    'placeholder'   => 'Enter your code',
])@endtext()

@text([
    'name'          => 'name',
    'label'          => 'Name',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('name') ?? $datum->name,
    'placeholder'   => 'Enter your name',
])@endtext()

@text([
    'name'          => 'width',
    'label'          => 'Width',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('width') ?? $datum->width,
    'type'          => 'number',
    'placeholder'   => 'Enter your width',
])@endtext()

@text([
    'name'          => 'height',
    'label'          => 'Height',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('height') ?? $datum->height,
    'type'          => 'number',
    'placeholder'   => 'Enter your height',
])@endtext()

@text([
    'name'          => 'path',
    'label'          => 'Path',
    'col' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value'         => old('path') ?? $datum->path,
    'placeholder'   => 'Enter your path',
])@endtext()
