@forelse ($data as $datum)
    <tr>
        <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
        </td>
        <td><a href="{{ route($route . '.show', [$route_var => $datum->id]) }}">{{ sprintf('%08d', $datum->id) }}</a>
        </td>
        <td>{{ $datum->code }}</td>
        <td>{{ $datum->client }}</td>
        <td>{{ $datum->device }}</td>
        <td>{{ $datum->cache_expiration_date }}</td>
        <td>{{ $datum->cache_license_type }}</td>
        <td>{{ $datum->cache_no_of_license }}</td>
        <td>
            @btn_index_view([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])
            @endbtn_index_view()
            @btn_index_delete([
            'route' => $route,
            'route_var' => $route_var,
            'route_val' => $datum->id,
            ])@endbtn_index_delete()
        </td>
    </tr>
@empty
@endforelse
