@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('styles.index') }}">Styles</a> |
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
                    'value' => old('code') ?? $datum->code,
                    'placeholder' => 'Enter your code',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'name',
                    'value' => old('name') ?? $datum->name,
                    'placeholder' => 'Enter your name',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'width',
                    'value' => old('width') ?? $datum->width,
                    'type' => 'number',
                    'placeholder' => 'Enter your width',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'height',
                    'value' => old('height') ?? $datum->height,
                    'type' => 'number',
                    'placeholder' => 'Enter your height',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'path',
                    'value' => old('path') ?? $datum->path,
                    'placeholder' => 'Enter your path',
                    'disabled' => 1,
                    ])@endtext()
                </div>
                <a href="{{ route('styles.edit', ['style' => $datum->id]) }}" class="btn btn-sm btn-botejyu"><i
                        class="fa-solid fa-pencil"></i></a>
            </div>
        </div>
    </div>
@endsection
