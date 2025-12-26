@text([
'name' => 'id',
'label' => 'ID',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'disabled' => 1,
])@endtext()

@text([
'name' => 'code',
'label' => 'Code',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('code'),
'placeholder' => 'Enter your code',
])@endtext

@text([
'name' => 'name',
'label' => 'Name',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('name'),
'placeholder' => 'Enter your name',
])@endtext()

@uploader([
'name' => 'profile_photo',
'label' => 'Profile Photo',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'is_multiple' => 0,
])@enduploader()

@email([
    'name' => 'email',
    'label' => 'Email',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('email'),
    'placeholder' => 'Enter your email',
])@endtext()

@text([
'name' => 'mobile_no',
'label' => 'Mobile No',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('mobile_no'),
'placeholder' => 'Enter your mobile no',
])@endtext()

@password([
'name' => 'password',
'label' => 'Password',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('password'),
'placeholder' => 'Enter your password',
'is_toggle' => 1
])@endpassword()

@password([
'name' => 'cf_password',
'label' => 'Confirm Password',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('cf_password'),
'placeholder' => 'Confirm your password',
'is_toggle' => 1
])@endpassword()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? 1,
    ])@endcheckbox()
</div>
