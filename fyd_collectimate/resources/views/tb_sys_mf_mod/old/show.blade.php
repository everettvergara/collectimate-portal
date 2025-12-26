@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('mods.index') }}">MODULES</a> |
                Show
            </div>
            <div class="card-body overflow-auto">
                <div class="row mb-2">

                    @text([
                    'name' => 'id',
                    'value' => $datum->id,
                    'disabled' => 1,
                    ])@endtext

                    @text([
                    'name' => 'code',
                    'value' => $datum->code,
                    'placeholder' => 'Enter your code',
                    'disabled' => 1,
                    ])@endtext

                    @text([
                    'name' => 'name',
                    'value' => $datum->name,
                    'placeholder' => 'Enter your name',
                    'disabled' => 1,
                    ])@endtext

                    @select([
                    'name' => 'mod_group_id',
                    'label' => 'MOD GROUP',
                    'elements' => $mod_groups,
                    'value' => old('mod_group_id') ?? $datum->mod_group_id,
                    'disabled' => 1,
                    ])@endselect()


                    @text([
                    'name' => 'seq',
                    'label' => 'SEQUENCE',
                    'value' => old('seq') ?? $datum->seq,
                    'placeholder' => 'Enter your Sequence',
                    'disabled' => 1,
                    ])@endtext()

                    @text([
                    'name' => 'url',
                    'label' => 'URL',
                    'value' => old('url') ?? $datum->url,
                    'placeholder' => 'Enter your URL',
                    'disabled' => 1,
                    ])@endtext()

                    @textarea([
                    'name' => 'remarks',
                    'value' => old('remarks') ?? $datum->remarks,
                    'placeholder' => 'Enter the remarks',
                    'disabled' => 1,
                    ])@endtextarea()

                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        @checkbox([
                        'name' => 'is_active',
                        'value' => $datum->is_active,
                        'disabled' => 1,
                        ])@endcheckbox()
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        @checkbox([
                        'name' => 'is_visible',
                        'value' => old('is_visible') ?? $datum->is_visible,
                        'disabled' => 1,
                        ])@endcheckbox()
                    </div>

                </div>
                <a href="{{ route('mods.edit', ['mod' => $datum->id]) }}" class="btn btn-sm btn-botejyu"><i
                        class="fa-solid fa-pencil"></i></a>
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
                'is_edit' => 0,
                'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                'details' => $datum_access_types
                ])@enddindex()
            </div>
        </div>
    </div>
@endsection
