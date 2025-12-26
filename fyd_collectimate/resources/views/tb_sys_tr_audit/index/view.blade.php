@extends('layouts.app')
@section('head')
    {{-- HEAD HERE --}}
    @select2head()
    @endselect2head()
@endsection
@section('content')
    <div class="container">
        <div class="card rounded-4">
            <div class="card-body p-3 p-lg-4">
                <div class="mb-3 mb-md-4 pb-2 border-bottom">
                    <a class=" text-decoration-none text-black fs-6" href="{{ route('audits.index') }}">{{ 'Audit' }}
                        Report</a>
                </div>
                <form method="GET">
                    @csrf
                    <div class="form d-inline mb-3">
                        <div class="row g-2 g-md-3 align-items-start">
                            {{-- PRINT FILTERS HERE --}}
                            @datefield([
                            'name' => 'date_from',
                            'label' => 'Date From',
                            'col' => 'col-12 col-lg-4 col-xl-4 col-xxl-2',
                            'value' => old('date_from') ?? $date_from,
                            'label_hidden' => 1,
                            ])@enddatefield()

                            @datefield([
                            'name' => 'date_to',
                            'label' => 'Date To',
                            'col' => 'col-12 col-lg-4 col-xl-4 col-xxl-2',
                            'value' => old('date_to') ?? $date_to,
                            'label_hidden' => 1,
                            ])@enddatefield()

                            @select([
                            'name' => 'user_id',
                            'label' => 'User',
                            'label_hidden' => 1,
                            'elements' => $users,
                            'value' => old('user_id'),
                            ])@endselect()

                            <div class="col-12 col-lg-2">


                                <div class="p-0">
                                    @btn_form_submit([
                                    'formaction' => route('audits.index'),
                                    'class' => 'btn-md btn-danger'
                                    ])@endbtn_form_submit()
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card no-shadow my-3 overflow-hidden rounded-4 bg-white">
            <div class="card-body rounded-4 p-3 p-lg-4">
                <div class="mb-3 pb-2 border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">User Login</h6>
                    </div>
                </div>
                <div class="overflow-auto custom-scrollbar">
                    <table class="table table-sm table-hover custom-striped-table">
                        <thead class="bg-th">
                            {{-- TR HEADER HERE --}}
                            <tr>
                                <td>No.</td>
                                <td>@sortablelink('user', 'User')</td>
                                <td>@sortablelink('module', 'Module')</td>
                                <td>@sortablelink('remarks', 'Remarks')</td>
                                <td>@sortablelink('timestamp', 'Timestamp')</td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- TR BODY HERE --}}
                            @forelse ($data as $datum)
                                <tr>
                                    <td>{{ $loop->index + 1 + ($data->currentPage() - 1) * $data->perPage() }}
                                    </td>
                                    <td>{{ $datum->user }}</td>
                                    <td>{{ $datum->module }}</td>
                                    <td>{{ $datum->remarks }}</td>
                                    <td>{{ $datum->timestamp }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="">
                        {{-- PAGINATION --}}
                        @if (isset($data))
                            {!! $data->appends(\Request::except('page'))->render() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- SCRIPTS HERE --}}
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        @select2js([
            'model_path' => 'App\Models\tb_sys_mf_user',
            'column' => 'user_id',
            'placeholder' => 'Select the user'
        ]) @endselect2js()
    </script>
@endsection()
