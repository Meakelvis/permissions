@extends('main')

@section('content')
<div class="container-fluid">
    <table class="table table-bordered border-dark mt-4">
        <tbody>
            <tr>
                <td colspan="5" class="text-center"><h3>Add Vehicles</h3></td>
            </tr>
            <tr>
                <td class="table-secondary">
                    <strong>Name of the Applicant</strong>
                </td>
                <td>{{ $application->name }}</td>
                <td class="table-secondary" rowspan="3">
                    <strong>Travel Destination</strong>
                </td>
                <td class="table-secondary" rowspan="2">
                    <strong>From</strong>
                </td>
                <td rowspan="2">{{ $application->from }}</td>
            </tr>
            <tr>
                <td class="table-secondary"><strong>Title</strong></td>
                <td>{{ $application->title }}</td>
            </tr>
            <tr>
                <!-- <td colspan="2">Larry the Bird</td> -->
                <td class="table-secondary">
                    <strong>Date of Application</strong>
                </td>
                <td>{{ \Carbon\Carbon::parse($application->date_of_application)->format('d/m/Y')}}</td>
                <td class="table-secondary"><strong>To</strong></td>
                <td>{{ $application->to }}</td>
            </tr>
            <tr>
                <td class="table-secondary">
                    <strong>Purpose of the Travel</strong>
                </td>
                <td colspan="4">
                  {{ $application->purpose }}
                </td>
            </tr>
            <tr>
                <td class="table-secondary" colspan="2">
                    <strong>Validity</strong>
                </td>
                <td colspan="3">{{ \Carbon\Carbon::parse($application->valid_from)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($application->valid_to)->format('d/m/Y')}}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('applications.storeVehicles', $application) }}" method="post" autocomplete="off">
        @csrf
        <div class="card">
            <div class="card-body">
                <table class="table" id="vehicles_table">
                    <thead>
                        <tr>
                            <th>MOTOR VEHICLE No.</th>
                            <th>NAME OF DRIVER</th>
                            <th>No.OF OCCUPANTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="vehicle0">
                            <td>
                                <input type="text" name="vehicles[]" class="form-control"/>
                            </td>
                            <td>
                                <input type="text" name="driverNames[]" class="form-control"/>
                            </td>
                            <td>
                                <input type="number" name="occupants[]" class="form-control" min="1"/>
                            </td>
                        </tr>
                        <tr id="vehicle1"></tr>
                    </tbody>
                </table>
    
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <button id="add_row" class="btn btn-success pull-left">+ Add Row</button>
                        <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 mx-2">
            <button type="submit" class="btn btn-success">Save Vehicles</button>
        </div>
    </form>   
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        let row_number = 1;

        $("#add_row").click(function(e){
            e.preventDefault();
            let new_row_number = row_number - 1;

            $('#vehicle' + row_number).html($('#vehicle' + new_row_number).html()).find('td:first-child');
            $('#vehicles_table').append('<tr id="vehicle' + (row_number + 1) + '"></tr>');
            row_number++;
            });

            $("#delete_row").click(function(e){
            e.preventDefault();
            if(row_number > 1){
                $("#vehicle" + (row_number - 1)).html('');
                row_number--;
            }
        });
    });
</script>
@endsection