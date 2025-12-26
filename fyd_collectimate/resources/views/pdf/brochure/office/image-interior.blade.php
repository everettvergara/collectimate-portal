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

        <table style="width: 100%; border-collapse: collapse; margin: 30px auto 0 auto;">
            <tbody>
                @if ($listing_image_interiors->isNotEmpty())
                    @if ($listing_image_interiors->count() === 1)
                        {{-- Single image full width --}}
                        <tr>
                            <td colspan="3"
                                style="padding: 15px; text-align: center; background-color: transparent !important;">
                                <img src="{{ public_path('storage/images/Original/' . $listing_image_interiors[0]->attachment) }}"
                                    alt=""
                                    style="
                                width: 100%;
                                height: 480px;
                                object-fit: cover;
                                border-radius: 8px;
                                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                             ">
                            </td>
                        </tr>
                    @else
                        {{-- Multiple images in rows of 3 --}}
                        @foreach ($listing_image_interiors->chunk(3) as $row)
                            <tr>
                                @foreach ($row as $img_interior)
                                    <td
                                        style="padding: 15px; text-align: center; width: 33.33%; background-color: transparent !important;">
                                        <img src="{{ public_path('storage/images/Original/' . $img_interior->attachment) }}"
                                            alt=""
                                            style="
                                        width: 100%;
                                        height: 300px;
                                        object-fit: cover;
                                        border-radius: 8px;
                                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                     ">
                                    </td>
                                @endforeach
                                @for ($i = $row->count(); $i < 3; $i++)
                                    <td style="padding: 15px; width: 33.33%;"></td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="3" style="text-align: center; background-color: transparent !important;">
                            <img src="{{ public_path('storage/attachments/user/dummyproduct.jpg') }}" alt="Default Image"
                                style="max-width: 100%; max-height: 480px; object-fit: contain; border-radius: 8px;">
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
@endsection
