@forelse ($data as $datum)
    <tr>
        <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td><a
                href="{{ route($route . '.edit-approve', [$route_var => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
        </td>
        <td>{{ $datum->code }}</td>
        <td>{{ $datum->name }}</td>
        <td>{{ $datum->email }}</td>
        <td><input class="form-check-input" type="checkbox" value="1"
                {{ ($datum->is_approved ?? 0) == 1 ? 'checked' : '' }} disabled></td>
        <td>
            <div class="form d-inline">
                <a href="{{ route($route . '.edit-approve', [$route_var => $datum->id]) }}"
                    class="btn btn-sm btn-botejyu action-btn">
                    <i class="fa-solid fa-pencil"></i>
                </a>
            </div>
        </td>
    </tr>
@empty
@endforelse
