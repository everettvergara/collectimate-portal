@extends('layouts.app')

@section('content')
    <div class="containerfluid px-5">
        <div class="row">
            <div class="col-12 col-xxl-8 mb-3">
                <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
                    <div class="card-body rounded-3 p-3 p-lg-4">
                        <div class="mb-3 pb-2 border-bottom">
                            <a href="{{ route('users.profile-show', ['user' => Auth::id()]) }}"
                                class="text-black text-capitalize">ACCOUNT
                                PROFILE</a>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4 overflow-hidden mb-3 text-center">
                                @profileimage([
                                'srcImg' => 'storage/attachments/user/'.$datum->profile_photo,
                                'width' => '80%',
                                'height' => '100%',
                                'objectFit' => 'contain',
                                ])
                                @endprofileimage()
                            </div>
                            <div class="col-12 col-lg-8">

                                <div class="row g-1 g-md-2 mb-3 mb-md-4">
                                    @text([
                                    'name' => 'id',
                                    'label' => 'ID',
                                    'col' => 'col-12 mb-3',
                                    'input_class' => '',
                                    'value' => $datum->id,
                                    'disabled' => 1,
                                    ])@endtext

                                    @text([
                                    'name' => 'code',
                                    'label' => 'User Name',
                                    'col' => 'col-12 mb-3',
                                    'input_class' => '',
                                    'value' => $datum->code,
                                    'disabled' => 1,
                                    ])@endtext

                                    @text([
                                    'name' => 'name',
                                    'label' => 'Name',
                                    'col' => 'col-12 mb-3',
                                    'input_class' => '',
                                    'value' => $datum->name,
                                    'disabled' => 1,
                                    ])@endtext

                                    @email([
                                        'name' => 'email',
                                        'label' => 'Email',
                                        'col' => 'col-12 mb-3',
                                        'input_class' => '',
                                        'value' => $datum->email,
                                        'disabled' => 1
                                    ])
                                    @endemail

                                    @text([
                                    'name' => 'mobile_no',
                                    'label' => 'Mobile No',
                                    'col' => 'col-12 mb-3',
                                    'input_class' => '',
                                    'value' => $datum->mobile_no,
                                    'disabled' => 1,
                                    ])@endtext()
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('users.profile-edit', ['user' => $datum->id]) }}"
                                        class="btn btn-md btn-danger">Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xxl-4 mb-3">
                <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
                    <div class="card-body rounded-3 p-3 p-lg-4">
                            @dindex([
                            'title' => 'User Access Type',
                            'route' => 'user-access-types',
                            'header_var' => 'user',
                            'header_pk' => $datum->id,
                            'detail_var' => 'user_access_type',
                            'is_edit' => 0,
                            'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                            'details' => $user_access_types,
                            'status_id' => 1,
                            'tr_style' => 'max-height: 500px; overflow: auto;',
                            'tr_class' => 'text-nowrap',
                            ])@enddindex()
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
