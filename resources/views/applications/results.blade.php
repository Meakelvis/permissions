@extends('main')

@section('content')
<div class="container-fluid">
    <div class="btn-group">
        <a
            href="{{ route('applications.pdf', $application) }}"
            class="
                btn btn-primary
            "
            ><i class="fas fa-download fa-sm text-white-50"></i> Generate
            PDF</a
        >

        @can('can-revert')
            @if ($application->status=='pending')
                <form action="{{ route('applications.approve', $application) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success mx-4">Approve</button>
                </form>

                <form action="{{ route('applications.reject', $application) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            @endif
        @endcan
        
    </div>
    
    <table class="table table-bordered border-dark mt-4">
      <tbody>
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
            <td class="table-secondary">
                <strong>Phone Number</strong>
            </td>
            <td colspan="4">
              {{ $application->phone_number }}
            </td>
          </tr>
          <tr>
              <td><strong>NO.</strong></td>
              <td><strong>MOTOR VEHICLE NO.</strong></td>
              <td colspan="2"><strong>NAME OF DRIVER</strong></td>
              <td><strong>NO OF OCCUPANTS</strong></td>
          </tr>
          @foreach ($vehicles as $key=>$vehicle)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>
                @canany(['add-organisation', 'can-revert', 'create-user'])
                        <a href="{{ route('applications.editVehicle', $vehicle) }}" class="btn">
                            <i class="fas fa-edit text-success"></i>
                        </a>
                        <form action="{{ route('applications.deleteVehicle', $vehicle) }}"  method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                @endcanany
                  {{ $vehicle->vehicle_no }}</td>
              <td colspan="2">{{ $vehicle->driver_name }}</td>
              <td>{{ $vehicle->no_of_occupants }}</td>
            </tr>
          @endforeach
          <tr>
              <td class="table-secondary" colspan="2">
                  <strong>Validity</strong>
              </td>
              <td colspan="3">{{ \Carbon\Carbon::parse($application->valid_from)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($application->valid_to)->format('d/m/Y')}}</td>
          </tr>
          <tr>
            <td colspan="5">
              <ol style="list-style-type: lower-roman;">
                <li>Only motor vehicles whose details are captured in this letter are covered.</li>
                <li>You are required to comply with Government of Uganda and Ministry of Health Guidelines.</li>
                <li>This exemption only applies during the quarantine period and not during curfew time.</li>
                <li>The permission does not extend beyond the designed area specified in this letter.</li>
                <li>You are advised to keep this letter and your personal identification details in the vehicle at all times.</li>
              </ol>
            </td>
          </tr>
      </tbody>
    </table>

    <p>PERMANENT SECRETARY, MINISTRY OF WORKS AND TRANSPORT</p>

    <div class="visible-print text-center">
        {!! QrCode::size(100)->generate(Request::url()); !!}
        <p>Scan me to return to the original page.</p>
    </div>
    <div class="visible-print text-center">
        {!! QrCode::generate('Make me into a QrCode!'); !!}
        <p>Scan me to return to the original page.</p>
    </div>

</div>
@endsection