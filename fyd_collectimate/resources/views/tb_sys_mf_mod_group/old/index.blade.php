@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header text-white  bg-botejyu">
                FILTERS
            </div>
            <div class="card-body overflow-auto">
                <form method="GET" action="{{ route('mod-groups.index') }}">
                    @csrf
                    <div class="form d-inline mb-3">
                        <div class="row">
                            @text([
                            'name' => 'code',
                            'placeholder' => 'Enter the Code',
                            'col' => 'col-lg-4 col-md-6 col-sm-12',
                            'label_class' => '',
                            'value' => $code
                            ])@endtext()

                            @text([
                            'name' => 'name',
                            'placeholder' => 'Enter the Name',
                            'col' => 'col-lg-4 col-md-6 col-sm-12',
                            'label_class' => '',
                            'value' => $name
                            ])@endtext()
                        </div>
                        <button type="submit" class="btn btn-sm btn-botejyu form-btn mt-3"><i class="far fa-search"
                                style="font-weight: 900"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mt-3 mb-3">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('mod-groups.index') }}">MOD
                    GROUPS</a>
            </div>
            <div class ="card-body">
                <table class="table table-sm table-striped">
                    <thead class="table-light-blue">
                        <tr>
                            <td>No.</td>
                            <td>@sortablelink('id', 'ID')</td>
                            <td>@sortablelink('code', 'Code')</td>
                            <td>@sortablelink('name', 'Name')</td>
                            <td>@sortablelink('parent_mod_group', 'Parent MOD Group')</td>
                            <td>@sortablelink('seq', 'Sequence')</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $datum)
                            <tr>
                                <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
                                </td>
                                <td><a
                                        href="{{ route('mod-groups.show', ['mod_group' => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
                                </td>
                                <td>{{ $datum->code }}</td>
                                <td>{{ $datum->name }}</td>
                                <td>{{ $datum->parent_mod_group }}</td>
                                <td>{{ $datum->seq }}</td>
                                <td>
                                    <div class="form d-inline">
                                        <a href="{{ route('mod-groups.edit', ['mod_group' => $datum->id]) }}"
                                            class="btn btn-sm btn-botejyu action-btn">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                    </div>
                                    <form method="POST" class="form d-inline "
                                        action="{{ route('mod-groups.destroy', ['mod_group' => $datum->id]) }} "
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value="Delete!" class="btn btn-sm btn-danger action-btn"
                                            onclick="return confirm('Are you sure you want to delete? This action is final')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

                <div class="form d-inline">
                    <a href="{{ route('mod-groups.create') }}" class="btn btn-sm btn-botejyu mb-3 create-btn">
                        <i class="fa-regular fa-plus"></i> New Record
                    </a>
                </div>
                {!! $data->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
