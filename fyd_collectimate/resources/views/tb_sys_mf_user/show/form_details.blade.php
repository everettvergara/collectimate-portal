<div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
    <div class="card-body rounded-3 p-3 p-lg-4">
        @php
            $tabs = [
                [
                    'title' => 'User Access Type',
                    'content' => view('components.detail-index', [
                        'title' => '',
                        'route' => 'user-access-types',
                        'header_var' => $route_var,
                        'header_pk' => $route_val,
                        'detail_var' => 'user_access_type',
                        'is_edit' => 1,
                        'columns' => [['name' => 'access_type', 'label' => 'Access Type']],
                        'details' => $user_access_types,
                        'status_id' => 1,
                        'is_delete' => 1,
                        'tr_style' => 'max-height: 320px; overflow: auto;',
                        'tr_class' => 'text-nowrap',
                    ]),
                ],
            ];
        @endphp
        <div class="mb-3 mb-md-4">
            <x-tabs :tabs="$tabs" />
        </div>
    </div>
</div>
