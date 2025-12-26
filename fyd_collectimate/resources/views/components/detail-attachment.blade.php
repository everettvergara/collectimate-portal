<div class="d-flex align-items-center justify-content-between mb-3 {{ $ch ?? '' }} ">
    <span>{{ $title ?? 'DETAIL HEADER TITLE' }}</span>

    @if (($is_edit ?? 0) === 1 && ($status_id ?? 0) === 1)
        <a href="{{ route($route . '.create', [$header_var => $header_pk]) }}"
            class="btn btn-danger btn-sm border border-light">
            + Create New Record
        </a>
    @endif
</div>

<div class ="overflow-auto custom-scrollbar bg-white">
    <div class="table-responsive {{ $tr_class ?? '' }}">
        <table class="table table-sm table-hover">
            <thead class="bg-th">
                <tr>
                    <td>No.</td>
                    @forelse ($columns as $column)
                        <td>{{ $column['label'] }}</td>
                    @empty
                    @endforelse
                    <td>Actions</td>
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
                        <td>
                            <div class="form d-inline">
                                <a href="{{ asset('storage/' . $path . '/' . $detail->attachment) }}"
                                    class="btn btn-outline-transparent btn-sm mb-1 action-btn" target="_blank" download>
                                    {{-- <i class="fas fa-download"></i> --}} Download
                                </a>
                            </div>
                            @if (($is_edit ?? 0) === 1 && ($status_id ?? 0) === 1)
                                <form method="POST" class="form d-inline "
                                    action="{{ route($route . '.destroy', [$detail_var => $detail->id]) }} "
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" value="Delete!"
                                        class="btn btn-outline-transparent btn-sm mb-1 action-btn"
                                        onclick="return confirm('Are you sure you want to delete? This action is final')">
                                        {{-- <i class="fa-regular fa-trash-can"></i> --}} Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
