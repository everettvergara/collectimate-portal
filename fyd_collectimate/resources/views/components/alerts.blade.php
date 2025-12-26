@if (!isset($show) || $show)
    <div class="modal fade" tabindex="-1" id="alert">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex flex-column text-center">
                        @php
                            $type = $type ?? 'success';
                        @endphp
                        @if ($type)
                            @if ($type === 'danger')
                                <div>
                                    <lottie-player id="lottie-container" src="/storage/lottie/failed.json"
                                        background="transparent" speed="1" style="width: 100%; height: 180px;" loop
                                        autoplay>
                                    </lottie-player>
                                </div>
                                <div style="margin-top: -20px; margin-bottom: 25px">
                                    <h5 class="fw-bold">Error</h5>
                                    <h6 class="mb-3 mb-md-4">{{ $slot }}</h6>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            @else
                                <lottie-player id="lottie-container" src="/storage/lottie/check-success.json"
                                    background="transparent" speed="1" style="width: 100%; height: 180px;"
                                    autoplay>
                                </lottie-player>
                                <h5 class="fw-bold text-capitalize">{{ $type ?? 'Success' }}</h5>
                                <h6 class="mb-3 mb-md-4">{{ $slot }}</h6>
                                <div>
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            @endif
                        @else
                            <lottie-player id="lottie-container" src="/storage/lottie/check-success.json"
                                background="transparent" speed="1" style="width: 100%; height: 180px;" autoplay>
                            </lottie-player>
                            <h5 class="fw-bold text-capitalize">{{ $type ?? 'Success' }}</h5>
                            <h6 class="mb-3 mb-md-4">{{ $slot }}</h6>
                            <div>
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
