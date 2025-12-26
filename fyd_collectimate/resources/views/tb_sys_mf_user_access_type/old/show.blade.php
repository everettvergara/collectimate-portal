@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white "
                    href="{{ route('users.edit', ['user' => $datum->user_id]) }}">USER ACCESS TYPE</a> | Show
            </div>
            <div class="card-body overflow-auto">
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
                    'disabled' => 1,
                    ])@endselect()

                    @textarea([
                    'name' => 'remarks',
                    'value' => old('remarks') ?? $datum->remarks,
                    'placeholder' => 'Enter the remarks',
                    'disabled' => 1,
                    ])@endtextarea()

                </div>
                <a href="{{ route('user-access-types.edit', ['user_access_type' => $datum->id]) }}"
                    class="btn btn-sm btn-botejyu"><i class="fa-solid fa-pencil"></i></a>
            </div>
        </div>
    </div>
@endsection
