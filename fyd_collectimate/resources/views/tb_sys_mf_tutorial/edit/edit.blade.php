@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
@endsection
@section('content')
    <div class="container-fluid px-3 px-md-5">

        <div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
            <div class="card-body rounded-3 p-3 p-lg-4">
                <div class="mb-3 pb-2 border-bottom">
                    <a href="{{ route('tutorials.index') }}" class="text-black text-capitalize">{{ 'TUTORIALS' }}
                        |</a>
                    <span class="text-black text-capitalize"> Edit</span>
                </div>
                <div class="mb-4">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-2 g-md-3 mb-2">
                            @textarea([
                            'name' => 'description',
                            'label' => 'Description',
                            'col' => 'col-12',
                            'input_class' => '',
                            'value' => old('description') ?? $datum->description,
                            'placeholder' => 'Enter the description',
                            ])@endtextarea()
                        </div>
                        <div class="text-end">
                            @btn_form_submit([
                            'formaction' => route('tutorials.update'),
                            'class' => 'btn-md btn-danger'
                            ])@endbtn_form_submit()
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    {{-- SCRIPTS HERE --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script nonce="{{ $cspNonce }}">
        window.onload = function() {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: [
                        'heading',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                        'insertTable',
                        'undo',
                        'redo',
                        'alignment',
                        'fontSize',
                        'fontFamily',
                        'underline',
                        'strikethrough',
                        'code',
                        'highlight'
                    ],
                    language: 'en',
                })
                .catch(error => {
                    console.error(error);
                });
        };
    </script>
@endsection()
