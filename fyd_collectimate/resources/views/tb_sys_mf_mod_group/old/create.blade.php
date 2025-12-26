@extends('layouts.app')
@section('head')
    @select2head()
    @endselect2head()
@endsection()
@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('mod-groups.index') }}">MOD
                    GROUPS</a> | Create
            </div>
            <div class="card-body overflow-auto">
                <form method="POST" action="{{ route('mod-groups.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        @text([
                        'name' => 'id',
                        'disabled' => 1,
                        ])@endtext
                        @text([
                        'name' => 'code',
                        'value' => old('code'),
                        'placeholder' => 'Enter your code',
                        ])@endtext

                        @text([
                        'name' => 'name',
                        'value' => old('name'),
                        'placeholder' => 'Enter your name',
                        ])@endtext

                        @select([
                        'name' => 'parent_mod_group_id',
                        'label' => 'PARENT MOD GROUP',
                        'elements' => $parent_mod_groups,
                        'value' => old('parent_mod_group_id'),
                        ])@endselect()

                        @text([
                        'name' => 'seq',
                        'label' => 'SEQUENCE',
                        'value' => old('seq'),
                        'placeholder' => 'Enter your name'
                        ])@endtext

                        @textarea([
                        'name' => 'remarks',
                        'value' => old('remarks'),
                        'placeholder' => 'Enter the remarks',
                        ])@endtextarea()

                        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                            @checkbox([
                            'name' => 'is_active',
                            'value' => old('is_active') ?? 1,
                            ])@endcheckbox()
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-botejyu">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script nonce="{{ $cspNonce }}">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        @select2js([
            'model_path' => 'App\Models\tb_sys_mf_mod_group',
            'column' => 'parent_mod_group_id',
            'placeholder' => 'Select the parent mod group',
        ]) @endselect2js()
    </script>
@endsection()
