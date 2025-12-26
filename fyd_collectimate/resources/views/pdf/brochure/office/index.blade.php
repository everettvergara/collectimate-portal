<div class="container-fluid px-4 px-xl-5 h-100">
    @if ($type == 'property-information')
        @include('pdf.brochure.office.property-information', [
            'datum' => $datum,
            'listing_specs' => $listing_specs,
            'listing_bldg_services' => $listing_bldg_services,
            'listing_image_bldgs' => $listing_image_bldgs,
            'listing_other_infos' => $listing_other_infos,
        ])
    @elseif ($type == 'available-floors-or-units')
        @include('pdf.brochure.office.available-floors', [
            'datum' => $datum,
            'listing_units' => $listing_units,
        ])
    @elseif ($type == 'typical-office-floor-plan')
        @include('pdf.brochure.office.typical-office-floor-plan', [
            'datum' => $datum,
            'listing_image_floor_plans' => $listing_image_floor_plans,
        ])
    @elseif ($type == 'typical-retail-floor-plan')
        @include('pdf.brochure.office.typical-retail-floor-plan', [
            'datum' => $datum,
            'listing_image_floor_plans' => $listing_image_floor_plans,
        ])
    @elseif ($type == 'image-interior')
        @include('pdf.brochure.office.image-interior', [
            'datum' => $datum,
            'listing_image_interiors' => $listing_image_interiors,
        ])
    @elseif ($type == 'property-photos')
        @include('pdf.brochure.office.property-photo', [
            'datum' => $datum,
            'listing_image_bldgs' => $listing_image_bldgs,
        ])
    @endif
</div>
