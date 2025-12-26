<div class="d-flex align-items-center justify-content-between {{ $ch ?? '' }} ">
    <span>{{ $title ?? 'DETAIL HEADER TITLE' }}</span>

    @if (($is_edit ?? 0) === 1 && ($status_id ?? 0) === 1)
        <a href="{{ route($route . '.create', [$header_var => $header_pk]) }}"
            class="btn btn-danger btn-sm border border-light">
            + Create New Record
        </a>
    @endif
</div>

<div class ="overflow-auto custom-scrollbar bg-white mt-3">
    <div class="table-responsive {{ $tr_class ?? '' }}">
        <table class="table table-sm table-hover custom-striped-table">
            <thead class="bg-th">
                <tr>
                    <td>No.</td>
                    @forelse ($columns as $column)
                        <td>{{ $column['label'] }}</td>
                    @empty
                    @endforelse
                    @if (($is_edit ?? 0) === 1 && ($status_id ?? 0) === 1)
                        <td>Actions</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @forelse ($columns as $column)
                            <td>{{ $detail[$column['name']] }}</td>
                        @empty
                        @endforelse
                        @if (($is_edit ?? 0) === 1 && ($status_id ?? 0) === 1)
                            <td>
                                <div class="form d-inline">
                                    <a href="{{ route("$route.show", [$detail_var => $detail['id']]) }}"
                                        class="btn btn-outline-transparent btn-sm mb-1 action-btn">
                                        <i class="fa-solid fa-eye fs-6 text-danger"></i>
                                    </a>
                                </div>
                                <div class="form d-inline">
                                    <a href="{{ route("$route.edit", [$detail_var => $detail['id']]) }}"
                                        class="btn btn-outline-transparent btn-sm mb-1 action-btn">
                                        <i class="fa-solid fa-pen-to-square fs-6 text-danger"></i>
                                    </a>
                                </div>
                                @if (($is_delete ?? 0) === 1)
                                    <form method="POST" class="form d-inline "
                                        action="{{ route($route . '.destroy', [$detail_var => $detail['id']]) }} "
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value="Delete!"
                                            class="btn btn-outline-transparent btn-sm mb-1 action-btn"
                                            onclick="return confirm('Are you sure you want to delete? This action is final')">
                                            <i class="fa-regular fa-trash-can fs-6 text-danger"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>

</div>
