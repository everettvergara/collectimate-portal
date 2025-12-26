@forelse ($data as $datum)
    <tr>
        <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td><a href="{{ route($route . '.show', [$route_var => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a></td>
        <td>{{ $datum->filename }}</td>
        <td>{{ $datum->path }}</td>
        <td>{{ $datum->table_name }}</td>
        <td>
            @btn_index_view([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_view()
            @btn_index_delete([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_delete()
        </td>
    </tr>
@empty
@endforelse
