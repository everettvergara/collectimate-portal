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
                    href="{{ route('users.edit', ['user' => $datum->user_id]) }}">USER ACCESS TYPE</a> | Edit
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('user-access-types.update', ['user_access_type' => $datum->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        @hidden([
                        'name' => 'id',
                        'value' => $datum->id,
                        ])@endhidden()

                        @hidden([
                        'name' => 'user_id',
                        'value' => $datum->user_id,
                        ])@endhidden()

                        @select([
                        'name' => 'access_type_id',
                        'label' => 'ACCESS TYPE',
                        'elements' => $access_types,
                        'value' => old('access_type_id') ?? $datum->access_type_id,
                        ])@endselect()

                        @textarea([
                        'name' => 'remarks',
                        'value' => old('remarks') ?? $datum->remarks,
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
            'placeholder' => 'Select the type of contact'
        ]) @endselect2js()
    </script>
@endsection()
