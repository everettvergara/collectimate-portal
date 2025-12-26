@extends('layouts.pdf')

@section('content')
    @foreach ($data as $chunkIndex => $chunk)
        <div class="container-fluid px-3 px-md-5">
            <table class="table table-sm table-striped">
                <thead class="bg-th">
                    <tr>
                        <th></th>
                        @foreach ($chunk as $datum)
                            @php
                                $image = $listing_image_bldgs->firstWhere('listing_id', $datum->id);
                            @endphp
                            <th class="align-middle text-center" style="padding-top: 20px;">
                                @if ($image)
                                    <div class="" style="padding: 2px;">
                                        <img src="{{ public_path('storage/images/Original/' . $image->attachment) }}"
                                            alt="" class="h-100 rounded-3"
                                            style="max-height: 200px; object-fit: contain; border-radius: 8px;">
                                        <h6 class="text-primary fw-bold fs-7" style="margin-top: 5px; margin-bottom: 10px;">
                                            {{ $datum->name }}
                                        </h6>
                                    </div>
                                @else
                                    <div class="" style="padding: 2px;">
                                        <img src="{{ public_path('storage/attachments/user/dummyproduct.jpg') }}"
                                            alt="" class="w-100 h-100 rounded-3"
                                            style="max-height: 170px; object-fit: contain; border-radius: 8px;">
                                        <h6 class="text-primary mb-0 fw-bold fs-7" style="margin-top: 5px;">
                                            {{ $datum->name }}
                                        </h6>
                                    </div>
                                @endif
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-black fw-bold fs-7 text-nowrap">Floor Plan</td>
                        @foreach ($chunk as $datum)
                            @php
                                $floorPlan = $listing_image_floor_plans->firstWhere('listing_id', $datum->id);
                            @endphp

                            <td class="p-3 text-center align-middle">
                                @if ($floorPlan)
                                    <img src="{{ public_path('storage/images/Original/' . $floorPlan->attachment) }}"
                                        alt="" class="w-100 h-100"
                                        style="max-height: 220px; object-fit: contain; border-radius: 8px; padding: 10px">
                                @else
                                    <h6 class="fs-7" style="font-weight: 400;">To Follow</h6>
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    @include('home.compare_details.table.tbody.location', [
                        'data' => $chunk,
                    ])

                    <tr>
                        <td class="text-black fw-bold fs-7">Units</td>
                        @foreach ($chunk as $datum)
                            <td class=" py-4"style="vertical-align: top;">
                                <table class="table table-sm mb-0 rounded-4">
                                    <thead>
                                        <tr>
                                            <th class="fs-8 align-middle text-center">Floor/Unit</th>
                                            <th class="align-middle">
                                                <h6 class="mb-0 text-center" style="font-size: 8px;">Area Size</h6>
                                                <h6 class="mb-0 text-center" style="font-weight: 400; font-size: 8px;">(m²)
                                                </h6>
                                            </th>
                                            <th class="fs-8 align-middle text-center">Rent</th>
                                            <th class="fs-8 align-middle text-center">Handover Condition</th>
                                            <th class="fs-8 align-middle text-center">Availability</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listing_units->where('listing_id', $datum->id) as $unit)
                                            <tr>
                                                <td class="text-center fs-8">{{ $unit->floor }}/{{ $unit->unit }}
                                                </td>
                                                <td class="text-center fs-8">{{ number_format($unit->area_size, 2) }}</td>
                                                <td class="text-center fs-8">{{ number_format($unit->rental, 2) }}</td>
                                                <td class="text-center fs-8">{{ $unit->handover_condition }}</td>
                                                <td class="text-center fs-8">{{ $unit->availability }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        @endforeach
                    </tr>

                    @include('home.compare_details.table.tbody.building_specificatons', [
                        'data' => $chunk,
                        'listing_specs' => $listing_specs,
                    ])

                    @include('home.compare_details.table.tbody.building_services', [
                        'data' => $chunk,
                        'listing_bldg_services' => $listing_bldg_services,
                    ])

                    @include('home.compare_details.table.tbody.fees_and_charges', [
                        'data' => $chunk,
                        'listing_bldg_fees_charges' => $listing_bldg_fees_charges,
                    ])

                    @include('home.compare_details.table.tbody.other_information', [
                        'data' => $chunk,
                        'listing_other_infos' => $listing_other_infos,
                    ])
                </tbody>
            </table>

            {{-- Disclaimer shown only on the last chunk --}}
            @if ($chunkIndex === $data->count() - 1)
                <div class="my-5">
                    <div class="card h-100">
                        <div class="card-header bg-primary">
                            <h6 class="text-white fs-7 w-100 fw-bold" style="margin-bottom: 2px; padding: 8px;">DISCLAIMER</h6>
                        </div>
                        <div class="card-body py-0">
                            <ol class="my-3">
                                <li class="fs-7">This leasing material has been prepared in good faith for the information
                                    of potential lessees</li>
                                <li class="fs-7">The information does not form part of any offer or contract and is
                                    intended as a guide only</li>
                            </ol>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Page break between chunks, but not after the last one --}}
        @if ($chunkIndex < $data->count() - 1)
            <div class="page-break"></div>
        @endif
    @endforeach
@endsection
