@extends('layouts.app')

@section('content')
    <div class="containerfluid px-5">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div class="mb-3 pb-2 border-bottom">
                    <h6 class="text-black text-capitalize fs-6">Change Password</h6>
                </div>

                <form method="POST" action="{{ route('users.profile-update-password', ['user' => $datum->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-1 g-md-2 mb-3 mb-md-4">
                        @password([
                        'name' => 'password',
                        'label' => 'Password',
                        'label_class' => 'mb-1',
                        'col' => 'col-12 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('password'),
                        'placeholder' => 'Enter your password',
                        'is_toggle' => 1
                        ])@endpassword()

                        @password([
                        'name' => 'cf_password',
                        'label' => 'Confirm Password',
                        'label_class' => 'mb-1',
                        'col' => 'col-12 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('cf_password'),
                        'placeholder' => 'Confirm your password',
                        'is_toggle' => 1
                        ])@endpassword()
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-md btn-danger">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script nonce="{{ $cspNonce }}">
            @passwordjs(['name' => 'password'])
            @endpasswordjs()

            @passwordjs(['name' => 'cf_password'])
            @endpasswordjs()
        </script>
    @endsection()
