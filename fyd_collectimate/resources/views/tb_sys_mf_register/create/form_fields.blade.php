@text([
    'name' => 'id',
    'label'     => 'ID',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'disabled' => 1,
])@endtext()

@text([
    'name' => 'code',
    'label'     => 'Code',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('code'),
    'placeholder' => 'Enter your code',
])@endtext

@text([
    'name' => 'name',
    'label'     => 'Name',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('name'),
    'placeholder' => 'Enter your name',
])@endtext()

@uploader([
    'name'          => 'profile_photo',
    'label'         => 'Profile Photo',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'is_multiple'   => 0,
])@enduploader()

@email([
    'name' => 'email',
    'label'     => 'Email',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('email'),
    'placeholder' => 'Enter your email',
])@endtext()

@text([
    'name' => 'mobile_no',
    'label'     => 'Mobile No',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('mobile_no'),
    'placeholder' => 'Enter your mobile no',
])@endtext()

@select([
    'name'      => 'user_type_id',
    'label'     => 'User Type',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'elements'  => $user_types,
    'value'     => old('user_type_id'),
])@endselect()
