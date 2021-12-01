@extends('main')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    <div
        class="d-sm-flex align-items-center justify-content-between mb-4"
    >
        <h1 class="h3 mb-0 text-gray-800">MDA Applications</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Special Clearences for org</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Application No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Vehicle No</th>
                            <th>NIN</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mdas as $mda)
                            <tr>
                                <td>
                                    <a href="{{ route('mda.preview', $mda) }}" target="blank">
                                        GOU/2021/MOWT/MDA/{{ now()->month }}/{{ 1000 + $mda->id }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($mda->create_at)->format('d/m/Y')}}</td>
                                <td>
                                    {{ $mda->name }}
                                </td>
                                <td>{{ $mda->vehicle_no }}</td>
                                <td>{{ $mda->nin }}</td>
                                <td>
                                    @switch($mda->status)
                                        @case('cleared')
                                            <p class="text-success">{{ Str::upper($mda->status) }}</p>
                                            @break
                                        @case('rejected')
                                            <p class="text-danger">{{ Str::upper($mda->status) }}</p>
                                            @break
                                        @case('pending')
                                            {{ Str::upper($mda->status) }}
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection