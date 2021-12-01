@extends('main')

@section('content')
<div class="container-fluid">
    <div class="btn-group">
        <a
            href="{{ route('data.pdf', $data) }}"
            class="
                btn btn-primary
            "
            ><i class="fas fa-download fa-sm text-white-50"></i> Generate
            PDF</a
        >

        @can('can-revert')
            @if ($data->status=='pending')
                <form action="{{ route('data.approve', $data) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success mx-4">Approve</button>
                </form>

                <form action="{{ route('data.reject', $data) }}" method="POST">
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
              <td>{{ $data->applicant_name }}</td>
              <td class="table-secondary" rowspan="3">
                  <strong>Travel Destination</strong>
              </td>
              <td class="table-secondary" rowspan="2">
                  <strong>From</strong>
              </td>
              <td rowspan="2">{{ $data->from }}</td>
          </tr>
          <tr>
              <td class="table-secondary"><strong>Title</strong></td>
              <td>{{ $data->title }}</td>
          </tr>
          <tr>
              <!-- <td colspan="2">Larry the Bird</td> -->
              <td class="table-secondary">
                  <strong>Date of Application</strong>
              </td>
              <td>{{ \Carbon\Carbon::parse($data->date_of_application)->format('d/m/Y')}}</td>
              <td class="table-secondary"><strong>To</strong></td>
              <td>{{ $data->to }}</td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Address</strong>
              </td>
              <td colspan="4">{{ $data->address }}</td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Purpose of the Travel</strong>
              </td>
              <td colspan="4">
                {{ $data->purpose_of_travel }}
              </td>
          </tr>
          <tr>
              <td class="table-secondary" colspan="3">
                  <strong
                      >Occupants (Depending on the size of the
                      Vehicle)</strong
                  >
              </td>
              <td colspan="2"></td>
          </tr>
          <tr>
              <td><strong>NO.</strong></td>
              <td><strong>MOTOR VEHICLE NO.</strong></td>
              <td colspan="2"><strong>NAME OF DRIVER</strong></td>
              <td><strong>NO OF OCCUPANTS</strong></td>
          </tr>
          @foreach ($occupants as $key=>$occupant)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $occupant->motor_vehicle_no }}</td>
              <td colspan="2">{{ $occupant->driver_name }}</td>
              <td>{{ $occupant->occupant_name }}</td>
            </tr>
          @endforeach
          <tr>
              <td class="table-secondary" colspan="2">
                  <strong>Validity</strong>
              </td>
              <td colspan="3">{{ \Carbon\Carbon::parse($data->valid_from)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($data->valid_to)->format('d/m/Y')}}</td>
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

</div>
@endsection