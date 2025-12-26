@extends('layouts.app')
@section('head')
    @select2head()
    @endselect2head()
@endsection()
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="mb-3 mb-md-4">
            <a class="text-black text-capitalize" href="{{ route('users.edit', ['user' => $datum->user_id]) }}">USER
                SITES
                |</a> <span class="text-black text-capitalize">Edit</span>
        </div>

        <div class="mb-4">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <form method="POST" action="{{ route('user-site.update', ['user_site' => $datum->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-1 g-md-2 mb-3 mb-md-4">
                            @text([
                            'name' => 'id',
                            'label' => 'ID',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'custom-input',
                            'disabled' => 1,
                            'value' => $datum->id,
                            ])@endtext

                            @text([
                            'name' => 'user_id',
                            'label' => 'User ID',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'custom-input',
                            'disabled' => 1,
                            'value' => $datum->user_id,
                            ])@endtext

                            @select([
                            'name' => 'site_id',
                            'label' => 'Site',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'custom-input',
                            'elements' => $sites,
                            'value' => old('site_id') ?? $datum->site_id,
                            ])@endselect()

                            @textarea([
                            'name' => 'remarks',
                            'label' => 'Remarks',
                            'col' => 'col-12 mb-3',
                            'input_class' => 'custom-input',
                            'value' => old('remarks') ?? $datum->remarks,
                            'placeholder' => 'Enter the remarks',
                            ])@endtextarea()
                        </div>
                        <button type="submit" class="btn btn-sm btn-botejyu">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        @select2js([
            'model_path' => 'App\Models\tb_fin_mf_site',
            'column' => 'site_id',
            'placeholder' => 'Select the site'
        ]) @endselect2js()
    </script>
@endsection()
