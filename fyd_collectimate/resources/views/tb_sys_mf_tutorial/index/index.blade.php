@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
@endsection
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="card rounded-3">
            <div class="card-body p-3 p-lg-4">
                <div class="mb-3 mb-md-4 pb-2 border-bottom">
                    <a class=" text-decoration-none text-black fs-6" href="{{ route('tutorials.index') }}">{{ 'TUTORIALS' }}
                    </a>
                </div>
                {!! html_entity_decode($datum->description) !!}
                <div class="">
                    <div class="form d-inline">
                        <div class="form d-inline">
                            <a href="{{ route('tutorials.edit') }}" class="{{ 'btn btn-sm btn-danger mb-3 create-btn' }}">
                                EDIT TUTORIAL
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- SCRIPTS HERE --}}
@endsection()
