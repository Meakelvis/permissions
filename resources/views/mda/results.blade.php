@extends('main')

@section('content')
<div class="container-fluid">
    <div class="btn-group">
        <a
            href="{{ route('pdf', $data) }}"
            class="
                btn btn-primary
            "
            target="blank"
            ><i class="fas fa-download fa-sm text-white-50"></i> Generate
            PDF</a
        >
    </div>
    
    <table class="table table-bordered border-dark mt-4">
      <tbody>
          <tr>
              <td class="table-secondary">
                  <strong>Name of the Applicant</strong>
              </td>
              <td>{{ $data->name_of_applicant }}</td>
              <td class="table-secondary" rowspan="3">
                  <strong>Travel Destination</strong>
              </td>
              <td class="table-secondary" rowspan="2">
                  <strong>From</strong>
              </td>
              <td rowspan="2">OPEN</td>
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
              <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}, {{ $data->created_at->diffForHumans() }}</td>
              <td class="table-secondary"><strong>To</strong></td>
              <td>OPEN</td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Address</strong>
              </td>
              <td colspan="4"></td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Purpose of the Travel</strong>
              </td>
              <td colspan="4">
                Work
              </td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Vehicle No.</strong>
              </td>
              <td colspan="4">01</td>
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
            <tr>
                <td>1</td>
                <td>{{ $data->vehicle_no }}</td>
                <td colspan="2">{{ $data->name_of_applicant }}</td>
                <td>3</td>
            </tr>
          <tr>
              <td class="table-secondary" colspan="2">
                  <strong>Validity</strong>
              </td>
              {{-- <td colspan="3">{{ \Carbon\Carbon::parse($data->valid_from)->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($data->valid_to)->format('d/m/Y')}}</td> --}}
              <td colspan="3">OPEN</td>
          </tr>
          <tr>
            <td colspan="5">
              <ol style="list-style-type: lower-roman;">
                <li>Only motor vehicles whose details are captured in this letter are covered.</li>
                <li>You are required to comply with Government of Uganda and Ministry od Health Guidelines.</li>
                <li>This permission does not extend beyond the designed area specified in this letter.</li>
                <li>You are advised to keep this letter in the vehicle at all times.</li>
              </ol>
            </td>
          </tr>
      </tbody>
    </table>

    <p>For any inquiries feel free to contact me over the matter.</p>
    <br>
    <p>PERMANENT SECRETARY</p>
    <br>
    <p>Copy to: The inspector General of Uganda Police</p>

</div>
@endsection