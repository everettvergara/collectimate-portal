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
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 15px!important;">
            <tr style="margin-top: 15px!important;">
                <td width="50%" style="vertical-align: top; margin: 0!important; padding: 0!important;">
                    <div class="text-center">
                        @if ($listing_image_bldgs->isNotEmpty())
                            @foreach ($listing_image_bldgs as $listing_image_bldg)
                                @if ($loop->first)
                                    <img src="{{ public_path('storage/images/Original/' . $listing_image_bldg->attachment) }}"
                                        alt="" class=""
                                        style="
																				width: auto;
																				height: 100%;
																				max-height: 460px;
																				object-fit: contain;
																				margin-bottom: 20px!important;
																		">
                                @endif
                            @endforeach
                        @else
                            <img src="{{ public_path('storage/attachments/user/dummyproduct.jpg') }}"
                                alt="Default Floor Plan" class="w-100 h-100 rounded-3"
                                style="max-height: 460px; object-fit: contain; margin-bottom: 20px!important">
                        @endif
                    </div>

                    <div class="text-center">
                        @if ($listing_image_maps->isNotEmpty())
                            @foreach ($listing_image_maps as $listing_image_map)
                                <img src="{{ public_path('storage/images/Original/' . $listing_image_map->attachment) }}"
                                    alt="" class=""
                                    style="
																		width: auto;
																		height: 100%;
																		max-height: 300px;
																		object-fit: cover;
																		margin-bottom: 20px!important;
																">
                            @endforeach
                        @else
                            <img src="{{ public_path('storage/attachments/user/dummyproduct.jpg') }}" alt="Default"
                                class="w-100 h-100 rounded-3"
                                style="max-height: 300px; object-fit: cover; margin-bottom: 20px!important">
                        @endif
                    </div>
                    <ol style="padding-left: 0px;">
                        <li>
                            <p class="fst-italic" style="margin-bottom: 0px; font-size: 17px;">This Leasing Material has
                                been prepared in good faith for the
                                information of
                                potential lessees</p>
                        </li>
                        <li>
                            <p class="fst-italic" style="margin-bottom: 0px; font-size: 17px;">The information does not
                                form
                                part of any offer or contract and
                                is intended as
                                a
                                guide only</p>
                        </li>
                    </ol>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <div class="bg-danger text-white" style="width: 100%;">
                        <h4 class="text-white fw-bold" style="margin: 0px; padding: 15px 10px;">PROPERTY INFORMATION
                        </h4>
                    </div>
                    <table width="100%" cellspacing="0" cellpadding="0">
                        @foreach ($listing_specs as $listing_spec)
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Developer
                                    </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->developer }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Building Grade
                                    </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->grade }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Completion
                                        Date</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->year_of_completion }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">No. of
                                        Storey</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->no_of_floors }}
                                    </h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">No. of
                                        Basement</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->no_of_basements }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Gross
                                        Leasable Area –
                                        Office (m²) </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ number_format($listing_spec->gross_leaseable_area, 2) }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Typical
                                        Floor Area – Office
                                        (m²)
                                    </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ number_format($listing_spec->typical_floor_area, 2) }}</h6>
                                </td>
                            </tr>
                            {{-- <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Gross
                                        Leasable Area –
                                        Commercial (m²) </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ number_format($listing_spec->gross_leaseable_area, 2) }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Typical
                                        Floor Area –
                                        Commercial (m²)</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ number_format($listing_spec->typical_floor_area, 2) }}</h6>
                                </td>
                            </tr> --}}
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Floor
                                        Efficiency</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->floor_efficiency }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Floor to
                                        Ceiling Height
                                        (m)</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->floor_to_ceiling_height }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Alloted
                                        Parking Slots
                                    </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->parking_allocation }}</h6>
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($listing_bldg_services as $listing_bldg_service)
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">AC
                                        System</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->ac_system }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">No.
                                        of Passenger
                                        Lifts</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->no_of_lifts_passenger }}
                                    </h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">No.
                                        of Service Lifts
                                    </h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->no_of_lifts_service }}
                                    </h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">
                                        Telco Providers</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->telco }}</h6>
                                </td>
                            </tr>
                        @endforeach


                        @foreach ($listing_specs as $listing_spec)
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">
                                        Density Ratio</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_spec->density_ratio }}</h6>
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($listing_bldg_services as $listing_bldg_service)
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">
                                        Operating Hours</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->operating_hours }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">
                                        Backup Power</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_bldg_service->backup_power }}</h6>
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($listing_other_infos as $listing_other_info)
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">PEZA
                                        Accredited</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_other_info->peza_accreditation }}</h6>
                                </td>
                            </tr>
                            <tr class="no-padding">
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">
                                        Sustainability</h6>
                                </td>
                                <td width="50%"
                                    style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                    <h6 class="mb-0 text-primary" style="margin: 0px; padding: 10px 0px;">
                                        {{ $listing_other_info->sustainability }}</h6>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
