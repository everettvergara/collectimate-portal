@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('users.index') }}">USERS</a> | Show
            </div>
            <div class="card-body overflow-auto">
                <div class="row mb-2">

                    @text([
                    'name' => 'id',
                    'value' => $datum->id,
                    'disabled' => 1,
                    ])@endtext

                    @text([
                    'name' => 'code',
                    'value' => $datum->code,
                    'placeholder' => 'Enter your code',
                    'disabled' => 1,
                    ])@endtext

                    @text([
                    'name' => 'name',
                    'value' => $datum->name,
                    'placeholder' => 'Enter your name',
                    'disabled' => 1,
                    ])@endtext()

                    @uploader([
                    'name' => 'profile_photo',
                    'label' => 'PROFILE PHOTO',
                    'path' => 'attachments/user',
                    'value' => $datum->profile_photo,
                    'is_multiple' => 0,
                    'disabled' => 1,
                    ])@enduploader()

                    @email([
                        'name' => 'email',
                        'value' => $datum->email,
                        'placeholder' => 'Enter your email',
                        'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'mobile_no',
                    'value' => $datum->mobile_no,
                    'placeholder' => 'Enter your mobile no',
                    'disabled' => 1,
                    ])@endtext()

                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        @checkbox([
                        'name' => 'is_active',
                        'value' => $datum->is_active,
                        'disabled' => 1,
                        ])@endcheckbox()
                    </div>

                </div>
                <a href="{{ route('users.edit', ['user' => $datum->id]) }}" class="btn btn-sm btn-botejyu"><i
                        class="fa-solid fa-pencil"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                @dindex([
                'title' => 'USER ACCESS TYPE',
                'route' => 'user-access-types',
                'header_var' => 'user',
                'header_pk' => $datum->id,
                'detail_var' => 'user_access_type',
                'is_edit' => 0,
                'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                'details' => $user_access_types,
                'tr_style' => 'max-height: 320px; overflow: auto;',
                'tr_class' => 'text-nowrap',
                ])@enddindex()
            </div>
        </div>
    </div>
@endsection
