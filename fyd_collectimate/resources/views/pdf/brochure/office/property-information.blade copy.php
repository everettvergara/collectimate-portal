<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            margin: 0;
            padding: 0;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .container-fluid {
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .h-100 {
            height: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-white {
            color: #fff !important;
        }

        .text-primary {
            color: #131741 !important;
        }

        .bg-primary {
            background-color: #131741 !important;
        }

        .bg-danger {
            background-color: #ea2429 !important;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .fw-bold {
            font-weight: 700;
        }

        .fst-italic {
            font-style: italic;
        }

        h1 {
            font-size: 30px;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
        }

        h5 {
            font-size: 18px;
        }

        h6,
        p {
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0;
            padding: 0;
            table-layout: fixed;
        }

        tr,
        td,
        th {
            padding: 0 !important;
            margin: 0 !important;
            border: none;
        }

        .no-padding>td {
            padding: 0 !important;
        }
    </style>
</head>

<body>
    <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 15px!important;">
        <tr class="bg-primary">
            <td width="18%" style="vertical-align: middle;"></td>
            <td width="37%" style="vertical-align: middle;">
                <h1 class="fw-bold mb-0 text-uppercase text-white">{{ $datum->name }}</h1>
            </td>
            <td width="45%" style="vertical-align: middle;">
                <h3 class="mb-0 text-white" style="font-weight: 400;">{{ $datum->address }}</h3>
            </td>
        </tr>
        <tr>
            <td width="15%" style="vertical-align: middle;">
                <div class="brochure-logo" style="margin-top: -95px !important; margin-left: -30px !important;">
                    <img src="{{ public_path('/storage/logo/brochure-logo.png') }}" alt=""
                        style="width: 100px; height: 120px; object-fit: contain;">
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
							max-height: 450px;
                            object-fit: contain;
                            margin-bottom: 20px!important;
					">
                            @endif
                        @endforeach
                    @else
                        <img src="{{ public_path('storage/attachments/user/dummyproduct.jpg') }}"
                            alt="Default Floor Plan" class="w-100 h-100 rounded-3"
                            style="max-height: 450px; object-fit: contain;">
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
                <table width="100%" cellspacing="0" cellpadding="0" style=" margin-top: 20px;">
                    <tr class="no-padding" width="100%">
                        <td width="100%" class="bg-danger text-white"
                            style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                            <h6 class="text-white fw-bold" style="margin: 0px; padding: 15px 10px;">PROPERTY INFORMATION
                            </h6>
                        </td>
                    </tr>
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
                                    {{ $listing_spec->gross_leaseable_area }}</h6>
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
                                    {{ $listing_spec->typical_floor_area }}</h6>
                            </td>
                        </tr>
                        <tr class="no-padding">
                            <td width="50%"
                                style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                <h6 class="text-primary fw-bold" style="margin: 0px; padding: 10px 0px;">Gross
                                    Leasable Area –
                                    Commercial (m²) </h6>
                            </td>
                            <td width="50%"
                                style="vertical-align: middle; margin: 0!important; padding: 0!important;">
                                <h6 class="text-primary" style="margin: 0px; padding: 10px 0px;">
                                    {{ $listing_spec->gross_leaseable_area }}</h6>
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
                                    {{ $listing_spec->typical_floor_area }}</h6>
                            </td>
                        </tr>
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
</body>

</html>
