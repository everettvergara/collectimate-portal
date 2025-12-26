<div class="card no-shadow mt-3 mb-3 overflow-hidden rounded-3 bg-white">
    <div class="card-body rounded-3 p-3 p-lg-4">
        @php
            $tabs = [
                [
                    'title' => 'License Histories',
                    'content' => view('components.detail-index', [
                        'title' => '',
                        'route' => 'license-histories',
                        'header_var' => $route_var,
                        'header_pk' => $route_val,
                        'detail_var' => 'license_history',
                        'is_edit' => 1,
                        'columns' => [
                            ['name' => 'device', 'label' => 'Device'],
                            ['name' => 'expiration_date', 'label' => 'Exp Date'],
                            ['name' => 'license_type', 'label' => 'License Type'],
                            ['name' => 'no_of_license', 'label' => 'No of License'],
                        ],
                        'details' => $license_histories,
                        'status_id' => 0,
                        'is_delete' => 0,
                    ]),
                ],
            ];
        @endphp
        <div class="mb-3 mb-md-4">
            <x-tabs :tabs="$tabs" />
        </div>
    </div>
</div>
