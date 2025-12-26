@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
    @if (isset($head))
        {!! html_entity_decode($head) !!}
    @endif
@endsection
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="mb-3 mb-md-4">
            <a class=" text-decoration-none text-black text-uppercase"
                href="{{ route($route . '.index') }}">{{ $title ?? 'PAGE TITLE' }}</a>
        </div>
        <form method="GET">
            @csrf
            <div class="form d-inline mb-3">
                <div class="row g-2 g-md-3 align-items-start">
                    {{-- PRINT FILTERS HERE --}}
                    @if (isset($filters))
                        {!! html_entity_decode($filters) !!}
                    @endif()
                    <div class="col-12 col-lg-2 col-xl-1 mb-xl-4">
                        <div class="p-0">
                            @btn_form_submit([
                            'formaction' => route( $route.'.index'),
                            'class' => 'btn-md btn-primary'
                            ])@endbtn_form_submit()

                            {{-- CREATE/ADD NEW --}}
                            @if (isset($custom_form_submit))
                                {!! html_entity_decode($custom_form_submit) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card no-shadow mt-3 mt-lg-4 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="overflow-auto custom-scrollbar">
                <table class="table table-sm table-hover">
                    <thead class="bg-th">
                        {{-- TR HEADER HERE --}}
                        @if (isset($tr_header))
                            {!! html_entity_decode($tr_header) !!}
                        @endif()
                    </thead>
                    <tbody>
                        {{-- TR BODY HERE --}}
                        @if (isset($tr_body))
                            {!! html_entity_decode($tr_body) !!}
                        @endif()
                    </tbody>
                </table>
                <div class="px-4">
                    {{-- CREATE/ADD NEW --}}
                    @if (($w_create ?? 1) == 1)
                        @btn_index_create([
                        'route' => $route,
                        ])@endbtn_index_create()
                    @endif

                    {{-- CREATE/ADD NEW --}}
                    @if (isset($custom_link))
                        {!! html_entity_decode($custom_link) !!}
                    @endif

                    {{-- PAGINATION --}}
                    @if (isset($data))
                        {!! $data->appends(\Request::except('page'))->render() !!}
                    @endif
                </div>
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
