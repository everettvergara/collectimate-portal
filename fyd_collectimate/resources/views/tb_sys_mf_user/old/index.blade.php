@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header text-white  bg-botejyu">
                FILTERS
            </div>
            <div class="card-body overflow-auto">
                <form method="GET" action="{{ route('users.index') }}">
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
                <a class=" text-uppercase text-decoration-none text-white " href="{{ route('users.index') }}">USERS</a>
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
                            <td>@sortablelink('is_active', 'Is Active')</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $datum)
                            <tr>
                                <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
                                </td>
                                <td><a
                                        href="{{ route('users.show', ['user' => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
                                </td>
                                <td>{{ $datum->code }}</td>
                                <td>{{ $datum->name }}</td>
                                <td>{{ $datum->email }}</td>
                                <td><input class="form-check-input" type="checkbox" value="1"
                                        {{ ($datum->is_active ?? 0) == 1 ? 'checked' : '' }} disabled></td>
                                <td>
                                    <div class="form d-inline">
                                        <a href="{{ route('users.edit', ['user' => $datum->id]) }}"
                                            class="btn btn-sm btn-botejyu action-btn">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                    </div>
                                    <form method="POST" class="form d-inline"
                                        action="{{ route('users.profile-reset-password', ['user' => $datum->id]) }} "
                                        class="d-inline" id="reset-password-{{ $datum->id }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" value="Reset Password!"
                                            form="reset-password-{{ $datum->id }}"
                                            class="btn btn-sm btn-outline-transparent action-btn"
                                            onclick="return confirm('Are you sure you want to reset the password? This action is final')">
                                            {{-- <i class="fas fa-key"></i> --}} Reset
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

                <div class="form d-inline">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-botejyu mb-3 create-btn">
                        <i class="fa-regular fa-plus"></i> New Record
                    </a>
                </div>
                {!! $data->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
