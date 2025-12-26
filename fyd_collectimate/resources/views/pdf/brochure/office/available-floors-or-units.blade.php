@extends('layouts.brochureofficepdf')
@section('content')
    <div>
        @php
            $nameFontSize = strlen($datum->name) > 30 ? '1vw' : '2vw';
            $addressFontSize = strlen($datum->address) > 40 ? '18px' : '18px';
        @endphp
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 15px!important;">
            <tr class="bg-primary">
                <td width="50%" style="vertical-align: middle;">
                    <h3
                        style="
                            margin: 0;
                            font-weight: bold;
                            text-transform: uppercase;
                            color: #ffffff;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            font-size: {{ $nameFontSize }};
                            max-width: 100%;
                            padding: 20px;
                            text-align: center;
                        ">
                        {{ $datum->name }}</h3>
                </td>
                <td width="50%" style="vertical-align: middle;">
                    <h3
                        style="
                            margin: 0;
                            font-weight: 400;
                            text-transform: uppercase;
                            color: #ffffff;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            font-size: {{ $addressFontSize }};
                            max-width: 100%;
                            padding: 20px;
                        ">
                        {{ $datum->address }}</h3>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: middle;">
                    <div class="brochure-logo" style="margin-top: -95px !important; margin-left: -30px !important;">
                        <img src="{{ public_path('/storage/logo/brochure-logo.png') }}" alt=""
                            style="width: 110px; height: 120px; object-fit: contain;">
                    </div>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0"
            style="margin-top: 15px!important; margin-bottom: 15px!important;">
            <tr style="margin-top: 15px!important;">
                <div class="overflow-hidden">
                    <div class="bg-danger" style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                        <h4 class="text-white mb-0 fw-bold text-center"
                            style="padding-top: 5px!important; padding-bottom: 5px!important;">AVAILABLE FLOORS / UNITS</h4>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Floor / Unit
                                </th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Area (m²)
                                </th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">No. of
                                    Bedrooms</th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Rental Rate
                                    (PHP/m2)</th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Selling
                                    Price (PHP/m2)
                                </th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Handover
                                    Condition*
                                </th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Availability
                                </th>
                                <th class="border-0 bg-transparent" style="vertical-align: top;" scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listing_units as $listing_unit)
                                <tr style="vertical-align: middle;">
                                    <td class="border-0 bg-transparent text-center">
                                        {{ $listing_unit->floor }} / {{ $listing_unit->unit }}</td>
                                    <td class="border-0 bg-transparent text-center">
                                        {{ number_format($listing_unit->area_size, 2) }}</td>
                                    <td class="border-0 bg-transparent text-center">{{ $listing_unit->no_of_br_id ?? '' }}
                                    </td>
                                    <td class="border-0 bg-transparent text-center">
                                        {{ number_format($listing_unit->rental, 2) }}</td>
                                    <td style="font-family: 'Poppins', 'DejaVu Sans', sans-serif;" class="text-center">
                                        &#8369; {{ number_format($listing_unit->selling_price, 2) }}
                                    </td>
                                    <td class="border-0 bg-transparent text-center">
                                        {{ $listing_unit->handover_condition }}</td>
                                    <td class="border-0 bg-transparent text-center">{{ $listing_unit->availability }}
                                    </td>
                                    <td class="border-0 bg-transparent text-center">{{ $listing_unit->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 30px!important;">
            <tr class="no-padding" style="vertical-align: top; margin-top: 30px!important;">
                <td width="50%" style="vertical-align: top; margin: 0!important; padding: 0!important;">
                    <div>
                        <p class="fst-italic" style="margin-bottom: 0!important; font-size: 15px;">*Handover Condition: BS -
                            Bare Shell ; WS - Warm Shell; PF -
                            Partially
                            Fitted; FF - Fully Fitted</p>
                        <p class="fst-italic" style="margin-bottom: 0!important; font-size: 15px;">Disclaimer:</p>
                        <ol style="margin: 0!important; font-size: 14px;">
                            <li>
                                <p class="fst-italic" style="margin-bottom: 0!important; font-size: 14px;">This Leasing
                                    Material has been prepared in good faith for
                                    the
                                    information of potential lessees
                                </p>
                            </li>
                            <li>
                                <p class="fst-italic" style="margin-bottom: 0!important; font-size: 14px;">The information
                                    does not form part of any offer or contract
                                    and
                                    is intended as a guide only
                                </p>
                            </li>
                        </ol>
                    </div>
                </td>
                <td width="50%" style="vertical-align: top; margin: 0!important; padding: 0!important;">
                    <div class="overflow-hidden">
                        <div class="bg-danger" style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                            <h4 class="text-white mb-0 fw-bold text-center"
                                style="padding-top: 5px!important; padding-bottom: 5px!important;">OTHER RATES
                            </h4>
                        </div>
                    </div>
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            @foreach ($listing_bldg_fees_charges as $charge)
                                @php
                                    $labels = [
                                        'Dues/CUSA' => 'CUSA (Php/m²/month)',
                                        'AC Fee' => 'AC Fees (Php/m²/month)',
                                        'Parking Fee' => 'Parking Rate (Php/slot/month)',
                                    ];
                                @endphp

                                @if (array_key_exists($charge->fee_type, $labels))
                                    <tr class="no-padding" style="vertical-align: top;">
                                        <td width="50%"
                                            style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                            <h6 class="text-black fw-bold" style="margin: 0px; padding: 10px 0px;">
                                                {{ $labels[$charge->fee_type] }}
                                            </h6>
                                        </td>
                                        <td width="50%"
                                            style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                            <h6 class="text-black" style="margin: 0px; padding: 10px 0px;">
                                                {{ $charge->fee ?? '—' }}</h6>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
