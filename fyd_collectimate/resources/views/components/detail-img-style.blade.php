<div class="d-flex align-items-center justify-content-between {{ $ch ?? '' }} ">
    {{ $title ?? 'DETAIL ATTACHMENT TITLE' }}
</div>

<div class="card no-shadow mt-2 mt-lg-3 mb-3 overflow-hidden rounded-3">
    <div class ="overflow-auto custom-scrollbar bg-white">
        <div class="table-responsive {{ $tr_class ?? '' }}" style="{{ $tr_style ?? '' }}">
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
                                @if (($is_edit ?? 0) === 1)
                                    <div class="form d-inline">
                                        <a href="{{ asset('storage/images/' . $detail->path . '/' . $detail->attachment) }}"
                                            class="btn btn-outline-transparent btn-sm mb-1 action-btn" target="_blank">
                                            {{-- <i class="fa-regular fa-eye"></i> --}} View
                                        </a>
                                    </div>
                                @endif
                                <div class="form d-inline">
                                    <a href="{{ asset('storage/images' . $detail->path . '/' . $detail->attachment) }}"
                                        class="btn btn-outline-transparent btn-sm mb-1 action-btn" target="_blank"
                                        download>
                                        {{-- <i class="fas fa-download fs-6"></i> --}} Download
                                    </a>
                                </div>
                                @if (($is_edit ?? 0) === 1)
                                    <form method="POST" class="form d-inline "
                                        action="{{ route($route . '.destroy', [$detail_var => $detail->id]) }} "
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value="Delete!"
                                            class="btn btn-outline-transparent btn-sm mb-1 action-btn"
                                            onclick="return confirm('Are you sure you want to delete? This action is final')">
                                            {{-- <i class="fa-regular fa-trash-can fs-6 text-danger"></i> --}} Delete
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
</div>
