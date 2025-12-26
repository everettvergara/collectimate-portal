@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('users.index') }}">USERS</a> | Edit
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('users.update', ['user' => $datum->id]) }}" enctype="multipart/form-data"
                    id="main-form">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'value' => $datum->id,
                        'disabled' => 1,
                        ])@endtext

                        @text([
                        'name' => 'code',
                        'value' => old('code') ?? $datum->code,
                        'placeholder' => 'Enter your code'
                        ])@endtext

                        @text([
                        'name' => 'name',
                        'value' => old('name') ?? $datum->name,
                        'placeholder' => 'Enter your name'
                        ])@endtext()

                        @uploader([
                        'name' => 'profile_photo',
                        'label' => 'PROFILE PHOTO',
                        'path' => 'attachments/user',
                        'value' => $datum->profile_photo,
                        'is_multiple' => 0,
                        ])@enduploader()

                        @email([
                            'name' => 'email',
                            'value' => old('email') ?? $datum->email,
                            'placeholder' => 'Enter your email',
                        ])@endtext()

                        @text([
                        'name' => 'mobile_no',
                        'value' => old('mobile_no') ?? $datum->mobile_no,
                        'placeholder' => 'Enter your mobile_no',
                        ])@endtext()

                        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                            @checkbox([
                            'name' => 'is_active',
                            'value' => old('is_active') ?? $datum->is_active,
                            ])@endcheckbox()
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-botejyu" form="main-form">
                        Submit
                    </button>
                </form>
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
                'is_edit' => 1,
                'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                'details' => $user_access_types,
                'status_id' => 1,
                'is_delete' => 1,
                'tr_style' => 'max-height: 320px; overflow: auto;',
                'tr_class' => 'text-nowrap',
                ])@enddindex()
            </div>
        </div>
    </div>
@endsection
