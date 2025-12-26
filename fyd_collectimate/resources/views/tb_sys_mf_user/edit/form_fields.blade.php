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
])@endtext()

@uploader([
'name' => 'profile_photo',
'label' => 'Profile Photo',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'path' => 'attachments/user',
'value' => $datum->profile_photo,
'is_multiple' => 0,
])@enduploader()

@email([
    'name' => 'email',
    'label' => 'Email',
    'col' => 'col-12 col-md-6 col-lg-3 mb-3',
    'input_class' => '',
    'value' => old('email') ?? $datum->email,
    'placeholder' => 'Enter your email',
])@endtext()

@text([
'name' => 'mobile_no',
'label' => 'Mobile No',
'col' => 'col-12 col-md-6 col-lg-3 mb-3',
'input_class' => '',
'value' => old('mobile_no') ?? $datum->mobile_no,
'placeholder' => 'Enter your mobile_no',
])@endtext()

<div class="col-12 col-lg-3 mb-3">
    @checkbox([
    'name' => 'is_active',
    'label' => 'Is Active',
    'value' => old('is_active') ?? $datum->is_active,
    ])@endcheckbox()
</div>
