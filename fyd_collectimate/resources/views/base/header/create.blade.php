@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
    @if (isset($head))
        {!! html_entity_decode($head) !!}
    @endif
@endsection
@section('content')
    <div class="container-fluid px-3 px-md-5 create-receipt-page">
        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div class="mb-3 pb-2 border-bottom">
                    <a href="{{ route($route . '.index') }}" class="text-black text-capitalize">{{ $title ?? 'PAGE TITLE' }}
                        |</a>
                    <span class="text-black text-capitalize"> Create</span>
                </div>
                <div class="mb-4">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-1 g-md-2 g-xl-3 mb-3 mb-md-4">
                            {{-- FORM FIELDS HERE --}}
                            @if (isset($form_fields))
                                {!! html_entity_decode($form_fields) !!}
                            @endif()
                        </div>
                        <div class="text-end">
                            @btn_form_submit([
                            'formaction' => route($route.'.store'),
                            'class' => 'btn-md btn-danger',
                            ])@endbtn_form_submit()
                        </div>

                        {{-- CUSTOM NEW --}}
                        @if (isset($custom_form_submit))
                            {!! html_entity_decode($custom_form_submit) !!}
                        @endif
                    </form>
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
