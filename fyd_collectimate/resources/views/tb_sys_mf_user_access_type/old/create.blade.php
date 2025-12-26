@extends('layouts.app')
@section('head')
    @select2head()
    @endselect2head()
@endsection()
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white "
                    href="{{ route('users.edit', ['user' => $user_id]) }}">USER ACCESS TYPE</a> | Create
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('user-access-types.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        @hidden([
                        'name' => 'id',
                        'value' => old('id'),
                        ])@endhidden()

                        @hidden([
                        'name' => 'user_id',
                        'value' => $user_id,
                        ])@endhidden()

                        @select([
                        'name' => 'access_type_id',
                        'label' => 'ACCESS TYPE',
                        'elements' => $access_types,
                        'value' => old('access_type_id'),
                        ])@endselect()

                        @textarea([
                        'name' => 'remarks',
                        'value' => old('remarks'),
                        'placeholder' => 'Enter the remarks',
                        ])@endtextarea()
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
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        @select2js([
            'model_path' => 'App\Models\tb_sys_mf_access_type',
            'column' => 'access_type_id',
            'placeholder' => 'Select the access type'
        ]) @endselect2js()
    </script>
@endsection()
