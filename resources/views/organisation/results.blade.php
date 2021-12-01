@extends('main')

@section('content')
<div class="container-fluid">

    <div class="btn-group">
        @if ($organisationPersonnel->status=='cleared')
            <a
                href="{{ route('pdf', $organisationPersonnel) }}"
                class="
                    btn btn-primary
                "
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                PDF</a
            >
        @endif

        @can('can-revert')
            @if ($organisationPersonnel->status=='rejected' || $organisationPersonnel->status=='cleared')
                <form action="{{ route('organisation.revert', $organisationPersonnel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="organisation_id" value="{{ $organisationPersonnel->organisation_id }}">
                    <button type="submit" class="btn btn-info mx-4">Reverse</button>
                </form>
            @endif
        @endcan
        

        @can('can-approve')
            @if ($organisationPersonnel->status=='pending')
                @if ($organisationPersonnel->status=='pending')
                    <form action="{{ route('organisation.approve', $organisationPersonnel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="organisation_id" value="{{ $organisationPersonnel->organisation_id }}">
                        <button type="submit" class="btn btn-success mx-4">Approve</button>
                    </form>

                    <a href="" 
                        data-toggle="modal"
                        data-target="#rejection"
                        class="btn btn-danger">Reject</a>
                @endif

                @if ($organisationPersonnel->status=='cleared')
                    <a href="" 
                        data-toggle="modal"
                        data-target="#rejection"
                        class="btn btn-danger">Reject</a>
                @endif

                @if ($organisationPersonnel->status=='rejected')
                    <form action="{{ route('organisation.approve', $organisationPersonnel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success mx-4">Approve</button>
                    </form>
                @endif
            @endif
        @endcan
        @canany(['view-users', 'can-revert', 'can-approve', 'add-organisation'])
            <a href="{{ route('organisation.editPersonnel', $organisationPersonnel) }}" class="btn">
                <i class="fas fa-edit text-success"></i>
            </a>
        @endcanany
        
    </div>
    
    <table class="table table-bordered border-dark mt-4">
      <tbody>
          @if ($organisationPersonnel->status == 'rejected')
              <tr>
                <td class="table-secondary">
                    <strong>Reason for Rejection</strong>
                </td>
                  <td colspan="5" style="color:red; font-weight:bold; font-size:large; text-transform: uppercase;">{{ $organisationPersonnel->reason_for_rejection }}</td>
              </tr>
          @endif
          <tr>
              <td class="table-secondary">
                  <strong>Name of the Applicant</strong>
              </td>
              <td>{{ $organisationPersonnel->name }}</td>
              <td class="table-secondary" rowspan="3">
                  <strong>Travel Destination</strong>
              </td>
              <td class="table-secondary" rowspan="2">
                  <strong>From</strong>
              </td>
              <td rowspan="2">HOME</td>
          </tr>
          <tr>
              <td class="table-secondary"><strong>Title</strong></td>
              <td>{{ $organisationPersonnel->title }}</td>
          </tr>
          <tr>
              <!-- <td colspan="2">Larry the Bird</td> -->
              <td class="table-secondary">
                  <strong>Date of Application</strong>
              </td>
              <td>{{ \Carbon\Carbon::parse($organisationPersonnel->created_at)->format('d/m/Y')}}</td>
              <td class="table-secondary"><strong>To</strong></td>
              <td>WORK</td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Organisation</strong>
              </td>
              <td colspan="4">{{ $organisationPersonnel->organisation->entity }}</td>
          </tr>
          @canany(['view-users', 'can-revert', 'can-approve', 'add-organisation'])
            <tr>
                <td class="table-secondary">
                    <strong>Phone No.</strong>
                </td>
                <td>{{ $organisationPersonnel->phone_no }}</td>
                <td class="table-secondary">
                    <strong>NIN</strong>
                </td>
                <td colspan="2">{{ $organisationPersonnel->nin }}</td>
            </tr>
          @endcanany
          <tr>
              <td class="table-secondary">
                  <strong>Vehicle No Plate</strong>
              </td>
              <td colspan="4">{{ $organisationPersonnel->vehicle_no }}</td>
          </tr>
          <tr>
              <td class="table-secondary">
                  <strong>Type of Vehicle</strong>
              </td>
              <td colspan="4">{{ $organisationPersonnel->type_of_vehicle }}</td>
          </tr>
          <tr>
              <td class="table-secondary" colspan="3">
                  <strong
                      >Occupants (Depending on the size of the
                      Vehicle)</strong
                  >
              </td>
              <td colspan="2">{{ $organisationPersonnel->occupants }}</td>
          </tr>
          <tr>
            <td class="table-secondary" colspan="2">
                <strong>Validity</strong>
            </td>
            <td colspan="3">
                {{ \Carbon\Carbon::parse($organisationPersonnel->date_of_approval)->format('d/m/Y')}} - {{ $finalDate }}
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <ol style="list-style-type: lower-roman;">
                <li>Only motor vehicles whose details are captured in this letter are covered.</li>
                <li>You are required to comply with Government of Uganda and Ministry of Health Guidelines.</li>
                <li>This exemption only applies during the quarantine period and not during curfew time.</li>
                <li>This permission does not extend beyond the designed area specified in this letter.</li>
                <li>You are advised to keep this letter and your personal identification details in the vehicle at all times.</li>
              </ol>
            </td>
          </tr>
      </tbody>
    </table>

    <p>PERMANENT SECRETARY, MINISTRY OF WORKS AND TRANSPORT</p>


</div>

{{-- rejection --}}
<div
    class="modal fade"
    id="rejection"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Reason for Rejection
                </h5>
                <button
                    class="close"
                    type="button"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('organisation.reject', $organisationPersonnel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm @error('reason_for_rejection')border border-danger @enderror " id="reason_for_rejection" name="reason_for_rejection" value="{{ old('reason_for_rejection') }}">
                            <input type="hidden" name="organisation_id" value="{{ $organisationPersonnel->organisation_id }}">
                        </div>
                        @error('reason_for_rejection')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row modal-footer">
                        <button type="submit" class="btn btn-success mx-4">Submit</button>
                        <a href="" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection