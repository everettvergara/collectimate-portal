@extends('layouts.empty')

@section('content')
    <section class="bg-sub-section h-100">
        <div class="container py-3 py-md-5">
            <div class="text-center mb-3 mb-md-5">
                <a class="navbar-brand p-0" href="/">
                    <img src="{{ asset('/storage/logo/logo.png') }}" alt="" class="mb-3"
                        style="
							width: auto;
							height: 100%;
							max-width: 100%;
							max-height: 80px;
							display: block;
							margin: 0 auto;
					">
                </a>
            </div>

            <div class="row g-3 g-md-5 align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xxl-5 mb-3">
                    <div class="mb-3 mb-md-4">
                        <h4 class="text-center mb-0">{{ __('Change Password') }}</h4>
                    </div>

                    <form method="POST" action="{{ route('passwords.update', ['email' => $email]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-1 g-md-2 mb-3 mb-md-4">
                            @password([
                            'name' => 'password',
                            'label' => 'Password',
                            'label_class' => 'mb-1',
                            'col' => 'col-12',
                            'input_class' => 'rounded-0 bg-white',
                            'value' => old('password'),
                            'placeholder' => 'Enter your password',
                            'is_toggle' => 1
                            ])@endpassword()

                            @password([
                            'name' => 'cf_password',
                            'label' => 'Confirm Password',
                            'label_class' => 'mb-1',
                            'col' => 'col-12',
                            'input_class' => 'rounded-0 bg-white',
                            'value' => old('cf_password'),
                            'placeholder' => 'Confirm your password',
                            'is_toggle' => 1
                            ])@endpassword()
                        </div>
                        <button type="submit" class="btn btn-md btn-black rounded-0 w-100 py-2">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
    </section>

    @footer()
    @endfooter()
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        @passwordjs(['name' => 'password'])
        @endpasswordjs()

        @passwordjs(['name' => 'cf_password'])
        @endpasswordjs()
    </script>
@endsection()
