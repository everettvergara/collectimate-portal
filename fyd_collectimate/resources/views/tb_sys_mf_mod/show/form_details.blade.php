<div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
    <div class="card-body rounded-3 p-3 p-lg-4">
        @php
            $tabs = [
                [
                    'title' => 'Access Types',
                    'content' => view('components.detail-index', [
                        'title' => '',
                        'route' => 'mod-access-types',
                        'header_var' => $route_var,
                        'header_pk' => $route_val,
                        'detail_var' => 'mod_access_type',
                        'is_edit' => 1,
                        'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                        'details' => $mod_access_types,
                        'status_id' => 1,
                        'is_delete' => 1,
                    ]),
                ],
            ];
        @endphp
        <div class="mb-3 mb-md-4">
            <x-tabs :tabs="$tabs" />
        </div>
    </div>
</div>
{{-- <div class="col-lg-12 col-md-12 col-sm-12">
    @dindex([
    'title' => 'ACCESS TYPES',
    'route' => 'mod-access-types',
    'header_var' => $route_var,
    'header_pk' => $route_val,
    'detail_var' => 'mod_access_type',
    'is_edit' => 0,
    'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
    'details' => $mod_access_types,
    'status_id' => 1,
    'is_delete' => 1,
    ])@enddindex()
</div> --}}
