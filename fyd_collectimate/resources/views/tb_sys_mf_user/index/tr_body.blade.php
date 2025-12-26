@forelse ($data as $datum)
    <tr>
        <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td><a href="{{ route($route . '.show', [$route_var => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a></td>
        <td>{{ $datum->code }}</td>
        <td>{{ $datum->name }}</td>
        <td>{{ $datum->email }}</td>
        <td><input class="form-check-input" type="checkbox" value="1" {{ ($datum->is_active ?? 0) == 1 ? 'checked' : '' }}
                disabled></td>
        <td>
            @btn_index_edit([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_edit()
            <form method="POST" class="form d-inline"
                action="{{ route($route . '.profile-reset-password', [$route_var => $datum->id]) }}" class="d-inline"
                id="reset-password-{{ $datum->id }}">
                @csrf
                @method('PUT')
                <button type="submit" value="Reset Password!" form="reset-password-{{ $datum->id }}"
                    class="btn btn-sm btn-outline-transparent action-btn"
                    onclick="return confirm('Are you sure you want to reset the password? This action is final')">
                    {{-- <i class="fas fa-key"></i> --}} Reset
                </button>
            </form>
        </td>
    </tr>
@empty
@endforelse
