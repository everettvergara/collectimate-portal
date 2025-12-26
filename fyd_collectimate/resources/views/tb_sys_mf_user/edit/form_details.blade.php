<div class="row d-none">
    <div class="col-12">
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
