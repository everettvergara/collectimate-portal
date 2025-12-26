@extends('layouts.app2')
@section('head')
    @select2head()
    @endselect2head()
@endsection()
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div id="countdown">
                    <span id="days"></span> Days
                    <span id="hours"></span> Hours
                    <span id="minutes"></span> Minutes
                    <span id="seconds"></span> Seconds
                </div>

                <div class="mb-3 mb-md-4 pb-2 border-bottom">
                    <h6 class="mb-0">{{ 'TEST PROMOTIONS' }} </h6>
                </div>
                <form method="POST" action="{{ route('tests.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        {{-- @text([
                        'name' => 'or_no',
                        'label' => 'OR No',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('or_no'),
                        'placeholder' => 'Enter your OR No',
                        ])@endtext()

                        @datetimefield([
                        'name' => 'or_date',
                        'label' => 'OR Date',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => 'custom-input',
                        'value' => old('or_date'),
                        'placeholder' => 'Enter the OR Date',
                        ])@enddatetimefield()

                        @select([
                        'name' => 'branch_id',
                        'label' => 'Branch',
                        'elements' => $branches,
                        'value' => old('branch_id'),
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'placeholder' => 'Enter the Branch',
                        ])@endselect()

                        @text([
                        'name' => 'total_amount',
                        'label' => 'Total Amount',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('total_amount'),
                        'type' => 'number',
                        'placeholder' => 'Enter the total amount',
                        ])@endtext() --}}

                        @text([
                        'name' => 'first_name',
                        'label' => 'First Name',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('first_name'),
                        'placeholder' => 'Enter the First Name',
                        ])@endtext()

                        @text([
                        'name' => 'last_name',
                        'label' => 'Last Name',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('last_name'),
                        'placeholder' => 'Enter the Last Name',
                        ])@endtext()

                        @text([
                        'name' => 'email',
                        'label' => 'Email',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('email'),
                        'placeholder' => 'Enter the email',
                        ])@endtext()

                        @text([
                        'name' => 'mobile_no',
                        'label' => 'Mobile No',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('mobile_no'),
                        'placeholder' => 'Enter the Mobile no',
                        ])@endtext()

                        @textarea([
                        'name' => 'address',
                        'label' => 'Address',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('address'),
                        'placeholder' => 'Enter the Address',
                        ])@endtextarea()

                        @select([
                        'name' => 'province_id',
                        'label' => 'Province',
                        'elements' => $provinces,
                        'value' => old('province_id'),
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'placeholder' => 'Enter the Province',
                        ])@endselect()

                        @select([
                        'name' => 'city_id',
                        'label' => 'City',
                        'elements' => $cities,
                        'value' => old('city_id'),
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'placeholder' => 'Enter the City',
                        ])@endselect()

                        @select([
                        'name' => 'brg_id',
                        'label' => 'Brg',
                        'elements' => $brgs,
                        'value' => old('brg_id'),
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'placeholder' => 'Enter the Brg',
                        ])@endselect()

                        @text([
                        'name' => 'zip',
                        'label' => 'Zip',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'value' => old('zip'),
                        'placeholder' => 'Enter the Zip',
                        ])@endtext()

                        @uploader([
                        'name' => 'attachment_file',
                        'label' => 'Receipt',
                        'col' => 'col-12 col-md-6 col-lg-4 mb-3',
                        'input_class' => '',
                        'is_multiple' => 0,
                        ])@enduploader()
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-md btn-danger">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const targetDate = new Date("{{ $target_date->format('Y-m-d H:i:s') }}");
        @select2js([
            'model_path' => 'App\Models\tb_re_mf_province',
            'column' => 'province_id',
            'placeholder' => 'All Provinces',
        ]) @endselect2js()

        $(document).ready(function() {
            var province_id = document.getElementById("province_id");
            var city_id = document.getElementById("city_id");
            $('.city_id').select2({
                placeholder: 'All Cities',
                theme: 'bootstrap-5',
                allowClear: true,
                ajax: {
                    type: 'POST',
                    url: "{{ route('select2.city') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term,
                            province_id: province_id.value,
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $('.brg_id').select2({
                placeholder: 'All Barangays',
                theme: 'bootstrap-5',
                allowClear: true,
                ajax: {
                    type: 'POST',
                    url: "{{ route('select2.brg') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term,
                            province_id: province_id.value,
                            city_id: city_id.value,
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

        function updateCountdown() {
            const now = new Date();
            const diff = targetDate - now;

            if (diff <= 0) {
                document.getElementById("countdown").innerHTML = "Time's up!";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((diff / (1000 * 60)) % 60);
            const seconds = Math.floor((diff / 1000) % 60);

            document.getElementById("days").textContent = days;
            document.getElementById("hours").textContent = hours;
            document.getElementById("minutes").textContent = minutes;
            document.getElementById("seconds").textContent = seconds;
        }

        setInterval(updateCountdown, 1000);
    </script>
@endsection
