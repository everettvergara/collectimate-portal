@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('statuses.index') }}">Status</a> |
                Create
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('statuses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'disabled' => 1,
                        ])@endtext()

                        @text([
                        'name' => 'code',
                        'value' => old('code'),
                        'placeholder' => 'Enter your code'
                        ])@endtext()
                        @text([
                        'name' => 'name',
                        'value' => old('name'),
                        'placeholder' => 'Enter your name'
                        ])@endtext()

                        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                            @checkbox([
                            'name' => 'is_active',
                            'value' => old('is_active') ?? 1
                            ])@endcheckbox()
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-botejyu">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
