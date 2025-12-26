@text([
    'name' => 'id',
    'label'     => 'ID',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => $datum->id,
    'disabled' => 1,
])@endtext()

@text([
    'name' => 'code',
    'label'     => 'Code',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('code') ?? $datum->code,
    'placeholder' => 'Enter your code',
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@endtext

@text([
    'name' => 'name',
    'label'     => 'Name',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('name') ?? $datum->name,
    'placeholder' => 'Enter your name',
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@endtext()

@uploader([
    'name'          => 'profile_photo',
    'label'         => 'Profile Photo',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'path'          => 'attachments/user',
    'value'         => $datum->profile_photo,
    'is_multiple'   => 0,
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@enduploader()

@email([
    'name' => 'email',
    'label'     => 'Email',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('email') ?? $datum->email,
    'placeholder' => 'Enter your email',
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@endtext()

@text([
    'name' => 'mobile_no',
    'label'     => 'Mobile No',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'value' => old('mobile_no') ?? $datum->mobile_no,
    'placeholder' => 'Enter your mobile_no',
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@endtext()

@select([
    'name'      => 'user_type_id',
    'label'     => 'User Type',
    'col' => 'col-12 col-md-6 col-xl-3 mb-3',
    'input_class' => 'custom-input',
    'elements'  => $user_types,
    'value'     => old('user_type_id') ?? $datum->user_type_id,
    'disabled'  => ($datum->is_approved ?? 0) === 1 ? 1 : null,
])@endselect()
