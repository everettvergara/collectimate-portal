@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('statuses.index') }}">Status</a> |
                Show
            </div>
            <div class="card-body overflow-auto">
                <div class="row mb-2">

                    @text([
                    'name' => 'id',
                    'value' => $datum->id,
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'code',
                    'value' => $datum->code,
                    'placeholder' => 'Enter your code',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'name',
                    'value' => $datum->name,
                    'placeholder' => 'Enter your name',
                    'disabled' => 1,
                    ])@endtext()

                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                        @checkbox([
                        'name' => 'is_active',
                        'value' => $datum->is_active,
                        'disabled' => 1,
                        ])@endcheckbox()
                    </div>

                </div>
                <a href="{{ route('statuses.edit', ['status' => $datum->id]) }}" class="btn btn-sm btn-botejyu"><i
                        class="fa-solid fa-pencil"></i></a>
            </div>
        </div>
    </div>
@endsection
