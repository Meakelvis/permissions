@extends('main')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expired Special Clearances</h1>
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
                            @canany(['can-revert', 'create-user', 'add-organisation'])
                                <th> 
                                    <input type="checkbox" id="checkAll" />
                                </th>
                            @endcanany
                            <th>Application No</th>
                            <th>Name of Applicant</th>
                            <th>Date of Application</th>
                            <th>Purpose</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expired as $record)
                        <tr id="sid{{ $record->id }}">
                            @canany(['can-revert', 'create-user', 'add-organisation'])
                                <td>
                                    <input type="checkbox" name="ids" value="{{ $record->id }}" class="checkBoxClass"/>
                                </td>
                            @endcanany
                            <td>
                                <a href="{{ route('applications.results', $record) }}">
                                    GOU/MOWT/2021/{{ \Carbon\Carbon::parse($record->created_at)->month }}/{{ 1000+$record->id }}
                                </a>
                            </td>
                            <td>
                                @canany(['add-organisation', 'can-revert', 'create-user'])
                                        <a href="{{ route('applications.editApplication',$record) }}" class="btn">
                                            <i class="fas fa-edit text-success"></i>
                                        </a>
                                        <a href="{{ route('applications.addVehicles',$record) }}" class="btn">
                                            <i class="fas fa-car text-warning"></i>
                                        </a>
                                @endcanany
                                {{ $record->name }}</td>
                            <td>{{ $record->date_of_application }}</td>
                            <td>{{ $record->purpose }}</td>
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