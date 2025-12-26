@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
    @if (isset($head))
        {!! html_entity_decode($head) !!}
    @endif
@endsection
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div class="mb-3 pb-2 border-bottom">
                    <a href="{{ route($header_route . '.show', [$header_route_var => $header_route_val]) }}"
                        class="text-black">{{ $title ?? 'PAGE TITLE' }} |</a>
                    <span class="text-black text-capitalize"> Create</span>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2 g-md-3 mb-2">
                        {{-- FORM FIELDS HERE --}}
                        @if (isset($form_fields))
                            {!! html_entity_decode($form_fields) !!}
                        @endif()
                    </div>
                    <div class="text-end">
                        @btn_form_submit([
                        'formaction' => route( $route.'.store'),
                        'class' => 'btn-md btn-danger'
                        ])@endbtn_form_submit()
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- SCRIPTS HERE --}}
    @if (isset($scripts))
        {!! html_entity_decode($scripts) !!}
    @endif
@endsection()
