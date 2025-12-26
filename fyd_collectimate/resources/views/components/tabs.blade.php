<ul class="nav nav-tabs" id="myTab" role="tablist">
    @php
        $activeIndex = 0; // Initialize as null

        // Check for any explicitly active tab
        foreach ($tabs as $index => $tab) {
            if (isset($tab['active']) && $tab['active'] === 1) {
                $activeIndex = $index; // Set to the index of the active tab
                break;
            }
        }

        // If no active tab was set, default to the last tab
        if ($activeIndex === null && count($tabs) > 0) {
            $activeIndex = count($tabs) - 1; // Set to the last tab
        }
    @endphp

    @foreach ($tabs as $index => $tab)
        @php
            $tabId = str_replace(' ', '', strtolower($tab['title']));
            $isActive = $index === $activeIndex;
        @endphp
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $isActive ? 'active' : '' }} text-black fs-7"
                id="{{ $tabId }}-tab" data-bs-toggle="tab"
                href="#{{ $tabId }}" role="tab"
                aria-controls="{{ $tabId }}"
                aria-selected="{{ $isActive ? 'true' : 'false' }}">
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content py-3" id="myTabContent">
    @foreach ($tabs as $index => $tab)
        <div class="tab-pane fade {{ $index === $activeIndex ? 'show active' : '' }}"
            id="{{ str_replace(' ', '', strtolower($tab['title'])) }}" role="tabpanel"
            aria-labelledby="{{ str_replace(' ', '', strtolower($tab['title'])) }}-tab">
            {!! $tab['content'] !!}
        </div>
    @endforeach
</div>
