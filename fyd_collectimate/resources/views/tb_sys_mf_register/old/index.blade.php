@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header text-white  bg-botejyu">
                FILTERS
            </div>
            <div class="card-body overflow-auto">
                <form method="GET" action="{{ route('registers.index') }}">
                    @csrf
                    <div class="form d-inline mb-3">
                        <div class="row">
                            @text([
                            'name' => 'name',
                            'placeholder' => 'Enter the Name',
                            'label_class' => '',
                            'value' => $name
                            ])@endtext()

                            @text([
                            'name' => 'email',
                            'placeholder' => 'Enter the Email',
                            'label_class' => '',
                            'value' => $email
                            ])@endtext()
                        </div>
                        <button type="submit" class="btn btn-sm btn-botejyu form-btn"><i class="far fa-search"
                                style="font-weight: 900"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mt-3 mb-3">
            <div class="card-header text-white  bg-botejyu">
                <a class=" text-uppercase text-decoration-none text-white "
                    href="{{ route('registers.index') }}">REGISTER</a>
            </div>
            <div class ="card-body">
                <table class="table table-sm table-striped">
                    <thead class="table-light-blue">
                        <tr>
                            <td>No.</td>
                            <td>@sortablelink('id', 'ID')</td>
                            <td>@sortablelink('code', 'Code')</td>
                            <td>@sortablelink('name', 'Name')</td>
                            <td>@sortablelink('email', 'Email')</td>
                            <td>@sortablelink('is_approved', 'Approved')</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $datum)
                            <tr>
                                <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
                                </td>
                                <td><a
                                        href="{{ route('registers.edit-approve', ['register' => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
                                </td>
                                <td>{{ $datum->code }}</td>
                                <td>{{ $datum->name }}</td>
                                <td>{{ $datum->email }}</td>
                                <td><input class="form-check-input" type="checkbox" value="1"
                                        {{ ($datum->is_approved ?? 0) == 1 ? 'checked' : '' }} disabled></td>
                                <td>
                                    <div class="form d-inline">
                                        <a href="{{ route('registers.edit-approve', ['register' => $datum->id]) }}"
                                            class="btn btn-sm btn-botejyu action-btn">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                {!! $data->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
