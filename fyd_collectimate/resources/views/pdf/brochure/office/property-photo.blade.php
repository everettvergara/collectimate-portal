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

        {{-- Image Grid (constrained to 75% of page width) --}}
        <div style="width: 75%; margin: 30px auto 0 auto;">
            <table width="100%" cellspacing="10" cellpadding="0">
                <tbody>
                    @foreach ($listing_image_bldgs->chunk(4) as $imageRow)
                        <tr>
                            @foreach ($imageRow as $listing_image_bldg)
                                <td width="25%" style="padding: 5px!important;">
                                    <div style="width: 100%; height: 320px; border: 3px solid #ccc; overflow: hidden;">
                                        <img src="{{ public_path('/storage/images/Original/' . $listing_image_bldg->attachment) }}"
                                            alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
