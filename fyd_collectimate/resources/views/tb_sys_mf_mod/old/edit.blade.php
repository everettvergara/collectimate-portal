@extends('layouts.app')
@section('head')
    @select2head()
    @endselect2head()
@endsection()
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('mods.index') }}">MODULES</a> |
                Edit
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('mods.update', ['mod' => $datum->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'value' => $datum->id,
                        'disabled' => 1,
                        ])@endtext

                        @text([
                        'name' => 'code',
                        'value' => old('code') ?? $datum->code,
                        'placeholder' => 'Enter your code'
                        ])@endtext

                        @text([
                        'name' => 'name',
                        'value' => old('name') ?? $datum->name,
                        'placeholder' => 'Enter your name'
                        ])@endtext

                        @select([
                        'name' => 'mod_group_id',
                        'label' => 'MOD GROUP',
                        'elements' => $mod_groups,
                        'value' => old('mod_group_id') ?? $datum->mod_group_id,
                        ])@endselect()

                        @text([
                        'name' => 'seq',
                        'label' => 'SEQUENCE',
                        'value' => old('seq') ?? $datum->seq,
                        'placeholder' => 'Enter your Sequence',
                        ])@endtext()

                        @text([
                        'name' => 'url',
                        'label' => 'URL',
                        'value' => old('url') ?? $datum->url,
                        'placeholder' => 'Enter your URL',
                        ])@endtext()

                        @textarea([
                        'name' => 'remarks',
                        'value' => old('remarks') ?? $datum->remarks,
                        'placeholder' => 'Enter the remarks',
                        ])@endtextarea()

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            @checkbox([
                            'name' => 'is_active',
                            'value' => old('is_active') ?? $datum->is_active,
                            ])@endcheckbox()
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            @checkbox([
                            'name' => 'is_visible',
                            'value' => old('is_visible') ?? $datum->is_visible,
                            ])@endcheckbox()
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-botejyu">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                @dindex([
                'title' => 'MOD ACCESS TYPE',
                'route' => 'mod-access-type',
                'header_var' => 'mod',
                'header_pk' => $datum->id,
                'detail_var' => 'mod_access_type',
                'is_edit' => 1,
                'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                'details' => $datum_access_types,
                'status_id' => 1,
                'is_delete' => 1,
                ])@enddindex()
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        @select2js([
            'model_path' => 'App\Models\tb_sys_mf_mod_group',
            'column' => 'mod_group_id',
            'placeholder' => 'Select the mod group',
        ]) @endselect2js()
    </script>
@endsection()
