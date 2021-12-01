@extends('main')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rejected Special Clearances</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rejected Applications</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr id="">
                            <th>Application No</th>
                            <th>Name of Applicant</th>
                            <th>Date of Application</th>
                            <th>Purpose</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejected as $record)
                        <tr>
                            <td>
                                <a href="{{ route('data.results', $record) }}">
                                    GOU/MOWT/2021/{{ now()->month }}/{{ 1000+$record->id }}
                                </a>
                            </td>
                            <td>{{ $record->applicant_name }}</td>
                            <td>{{ $record->date_of_application }}</td>
                            <td>{{ $record->purpose_of_travel }}</td>
                            <td>{{ $record->valid_from }}</td>
                            <td>{{ $record->valid_to }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection