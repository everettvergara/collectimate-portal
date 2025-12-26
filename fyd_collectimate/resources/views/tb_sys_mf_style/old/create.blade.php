@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('styles.index') }}">Styles</a> |
                Create
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('styles.store') }}" enctype="multipart/form-data">
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
                        ])@endtext()

                        @text([
                        'name' => 'name',
                        'value' => old('name'),
                        'placeholder' => 'Enter your name',
                        ])@endtext()

                        @text([
                        'name' => 'width',
                        'value' => old('width'),
                        'type' => 'number',
                        'placeholder' => 'Enter your width',
                        ])@endtext()

                        @text([
                        'name' => 'height',
                        'value' => old('height'),
                        'placeholder' => 'Enter your height',
                        ])@endtext()

                        @text([
                        'name' => 'path',
                        'value' => old('path'),
                        'placeholder' => 'Enter your path',
                        ])@endtext()
                    </div>
                    <button type="submit" class="btn btn-sm btn-botejyu">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
