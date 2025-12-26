<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        @php
            $tabs = [
                [
                    'title' => 'Image Style',
                    'content' => view('components.detail-img-style', [
                        'ch' => 'text-white  bg-botejyu',
                        'title' => '',
                        'route' => 'img-styles',
                        'detail_var' => 'img_style',
                        'is_edit' => 0,
                        'columns' => [
                            ['name' => 'style', 'label' => 'STYLE'],
                            ['name' => 'width', 'label' => 'Width'],
                            ['name' => 'height', 'label' => 'Height'],
                            ['name' => 'path', 'label' => 'Path'],
                        ],
                        'details' => $img_styles,
                    ]),
                ],
            ];
        @endphp
        <div class="mb-3 mb-md-4">
            <x-tabs :tabs="$tabs" />
        </div>
        {{-- @dimgstyle([
        'ch' => 'text-black',
        'title' => 'IMAGE STYLES',
        'route' => 'img-styles',
        'detail_var' => 'img_style',
        'is_edit' => 0,
        'columns' => [['name' => 'style', 'label' => 'STYLE'], ['name' => 'width', 'label' => 'Width'], ['name' =>
        'height', 'label' => 'HEIGHT'], ['name' => 'path', 'label' => 'PATH']],
        'details' => $img_styles,
        ])@enddimgstyle() --}}
    </div>
</div>
