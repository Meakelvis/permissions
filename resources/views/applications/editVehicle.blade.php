@extends('main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('applications.updateVehicle', $vehicle) }}" method="post" class="mx-auto">
        @csrf
        @method('PUT')
        <table class="table table-bordered border-dark">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Edit Vehicle</h3></td>
                </tr>
                <tr>
                    <td><strong>MOTOR VEHICLE NO.</strong></td>
                    <td colspan="2"><strong>NAME OF DRIVER</strong></td>
                    <td><strong>NO OF OCCUPANTS</strong></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="vehicleNo" class="form-control" value="{{ $vehicle->vehicle_no }}"/>
                    </td>
                    <td colspan="2">
                        <input type="text" name="driverName" class="form-control" value="{{ $vehicle->driver_name }}"/>
                    </td>
                    <td>
                        <input type="number" name="occupants" class="form-control" value="{{ $vehicle->no_of_occupants }}"/>
                    </td>
                  </tr>
            </tbody>
        </table>
    
        {{-- submit and cancel buttons --}}
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-4">
                Edit Vehicle
            </button>
            <a href="{{ route('applications') }}" class="btn btn-secondary"> Cancel </a>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
</script>
@endsection