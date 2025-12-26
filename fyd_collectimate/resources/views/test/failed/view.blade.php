@extends('layouts.app')
@section('head')
@endsection()
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div class="mb-3 mb-md-4 pb-2 border-bottom">
                    <h6 class="mb-0">{{ 'Submission Failed' }} </h6>
                </div>
                <p> Sorry, it looks like your submission is not valid.</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
