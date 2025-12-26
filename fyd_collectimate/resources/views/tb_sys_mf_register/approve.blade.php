@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                REGISTER | APPROVE
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" enctype="multipart/form-data" id="main-form">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'value' => $datum->id,
                        'disabled' => 1,
                        ])@endtext()

                        @text([
                        'name' => 'user_id',
                        'value' => $datum->user_id,
                        'disabled' => 1,
                        ])@endtext()

                        @text([
                        'name' => 'code',
                        'value' => old('code') ?? $datum->code,
                        'placeholder' => 'Enter your code',
                        'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@endtext()

                        @text([
                        'name' => 'name',
                        'value' => old('name') ?? $datum->name,
                        'placeholder' => 'Enter your name',
                        'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@endtext()

                        @uploader([
                        'name' => 'profile_photo',
                        'label' => 'PROFILE PHOTO',
                        'path' => 'attachments/user',
                        'value' => $datum->profile_photo,
                        'is_multiple' => 0,
                        'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@enduploader()

                        @email([
                            'name' => 'email',
                            'value' => old('email') ?? $datum->email,
                            'placeholder' => 'Enter your email',
                            'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@endtext()

                        @text([
                        'name' => 'mobile_no',
                        'value' => old('mobile_no') ?? $datum->mobile_no,
                        'placeholder' => 'Enter your mobile_no',
                        'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@endtext()

                        @select([
                        'name' => 'user_type_id',
                        'label' => 'USER TYPE',
                        'elements' => $user_types,
                        'value' => old('user_type_id') ?? $datum->user_type_id,
                        'disabled' => ($datum->is_approved ?? 0) === 1 ? 1 : null,
                        ])@endselect()

                        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                            @checkbox([
                            'name' => 'is_approved',
                            'value' => $datum->is_approved,
                            'disabled' => 1,
                            ])@endcheckbox()
                        </div>

                    </div>
                    @if (($datum->is_approved ?? 0) === 0)
                        <button type="submit" class="btn btn-sm btn-botejyu" form="main-form"
                            formaction="{{ route('registers.update', ['register' => $datum->id]) }}">
                            Save
                        </button>
                        <button type="submit" class="btn btn-sm btn-success"
                            onclick="return confirm('Are you sure you want to proceed? This action is final')"
                            form="main-form" formaction="{{ route('registers.approve', ['register' => $datum->id]) }}">
                            Approve <i class="fa fa-check" aria-hidden="true"></i>
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
