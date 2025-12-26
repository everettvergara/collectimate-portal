@forelse ($data as $datum)
    <tr>
        <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td><a href="{{ route($route . '.show', [$route_var => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
        </td>
        <td>{{ $datum->code }}</td>
        <td>{{ $datum->name }}</td>
        <td>{{ $datum->user }}</td>
        <td>{{ $datum->remarks }}</td>
        <td><input class="form-check-input" type="checkbox" value="1"
                {{ ($datum->is_active ?? 0) == 1 ? 'checked' : '' }} disabled></td>
        <td>
            @btn_index_edit([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_edit()
            @btn_index_delete([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_delete()
        </td>
    </tr>
@empty
@endforelse
