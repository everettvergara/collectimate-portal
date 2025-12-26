@extends('layouts.app')
@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="mb-3 mb-md-4">
            <a class="text-black text-capitalize" href="{{ route('users.edit', ['user' => $datum->user_id]) }}">USER
                SITES
                |</a> <span class="text-black text-capitalize">Show</span>
        </div>
        <div class="mb-4">
            <div class="row">
                <div class="col-12 col-lg-3">

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
                        'disabled' => 1,
                        ])@endselect()

                        @textarea([
                        'name' => 'remarks',
                        'label' => 'Remarks',
                        'col' => 'col-12 mb-3',
                        'input_class' => 'custom-input',
                        'value' => old('remarks') ?? $datum->remarks,
                        'placeholder' => 'Enter the remarks',
                        'disabled' => 1,
                        ])@endtextarea()

                    </div>
                    <a href="{{ route('user-site.edit', ['user_site' => $datum->id]) }}" class="btn btn-sm btn-botejyu">
                        {{-- <i class="fa-solid fa-pencil"></i> --}} Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
