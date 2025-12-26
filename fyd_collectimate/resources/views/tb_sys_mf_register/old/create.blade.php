@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                REGISTER
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('registers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'disabled' => 1,
                        ])@endtext()

                        @text([
                        'name' => 'code',
                        'value' => old('code'),
                        'placeholder' => 'Enter your code',
                        ])@endtext

                        @text([
                        'name' => 'name',
                        'value' => old('name'),
                        'placeholder' => 'Enter your name',
                        ])@endtext()

                        @uploader([
                        'name' => 'profile_photo',
                        'label' => 'PROFILE PHOTO',
                        'is_multiple' => 0,
                        ])@enduploader()

                        @email([
                            'name' => 'email',
                            'value' => old('email'),
                            'placeholder' => 'Enter your email',
                        ])@endtext()

                        @text([
                        'name' => 'mobile_no',
                        'value' => old('mobile_no'),
                        'placeholder' => 'Enter your mobile no',
                        ])@endtext()

                        @select([
                        'name' => 'user_type_id',
                        'label' => 'USER TYPE',
                        'elements' => $user_types,
                        'value' => old('user_type_id'),
                        ])@endselect()
                    </div>

                    <button type="submit" class="btn btn-sm btn-botejyu">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection()
