@extends('main')

@section('content')
<div class="container-fluid">
    <p style="color: red"><strong>GOU/2021/MOWT/MDA/{{ now()->month }}/{{ 1000+$mdaPersonnel->id }}</strong></p>
    <p style="margin-top: -15px">{{ date('d-m-Y') }}</p>
    <h4 style="font-weight: bold; text-align:center">SPECIAL CLEARANCE</h4>
    <hr>
    <p>{{ $mdaPersonnel->name }}</p>
    {{-- <p style="margin-top: -15px">{{ $mdaPersonnel->address }}</p> --}}
    {{-- <p style="margin-top: -15px">{{ $mdaPersonnel->from }}</p> --}}

    {{-- <p style="font-weight: bold">CLEARANCE TO TRAVEL TO {{ Str::upper($mdaPersonnel->to) }} FOR {{ Str::upper($mdaPersonnel->purpose_of_travel) }} DURING THE CORONA VIRUS QUARANTINE PERIOD LOCKDOWN</p> --}}

    <table class="table table-bordered border-dark mt-4">
        <tbody>
            <tr>
                <td class="title">
                    <strong>Name of the Applicant</strong>
                </td>
                <td>{{ $mdaPersonnel->name }}</td>
                <td class="title">
                    <strong>Travel Destination</strong>
                </td>
                <td>
                    <strong style="color: red">RESTRICTED TO ONLY TRAVEL FROM HOME TO OFFICE</strong>
                </td>
            </tr>
            <tr>
                <td class=" title"><strong>Title</strong></td>
                <td>{{ $mdaPersonnel->title }}</td>
            </tr>
            <tr>
                <!-- <td colspan="2">Larry the Bird</td> -->
                <td class=" title">
                    <strong>Date of Application</strong>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($mdaPersonnel->created_at)->format('d/m/Y') }}
                </td>
            </tr>
            {{-- <tr>
                <td class=" title">
                    <strong>Address</strong>
                </td>
                <td colspan="4">{{ $mdaPersonnel->address }}</td>
            </tr> --}}
            <tr>
                <td class=" title">
                    <strong>Purpose of the Travel</strong>
                </td>
                <td colspan="4">{{ $mdaPersonnel->purpose }}</td>
            </tr>
            <tr>
                <td class=" title">
                    <strong>Vehicle No.</strong>
                </td>
                <td colspan="4">{{ $mdaPersonnel->vehicle_no }}</td>
            </tr>
            <tr>
                <td class=" title" colspan="3">
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
                <td>{{ $mdaPersonnel->vehicle_no }}</td>
                <td colspan="2">{{ $mdaPersonnel->name }}</td>
                <td>3</td>
            </tr>
            <tr>
                <td class=" title" colspan="2">
                    <strong>Validity</strong>
                </td>
                <td colspan="3">
                    <strong>DAILY FROM 5:30AM - 7:00PM</strong>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <ol style="list-style-type: lower-roman">
                        <li>
                            Only motor vehicles whose details are
                            captured in this letter are covered.
                        </li>
                        <li>
                            You are required to comply with Government
                            of Uganda and Ministry of Health Guidelines.
                        </li>
                        <li>
                            This exemption only applies during the
                            quarantine period and not during curfew
                            time.
                        </li>
                        <li>
                            This permission does not extend beyond the
                            designed area specified in this letter.
                        </li>
                        <li>
                            You are advised to keep this letter in the
                            vehicle at all times.
                        </li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="text">
            <br>
            <p><strong>PERMANENT SECRETARY, MINISTRY OF WORKS AND TRANSPORT</strong></p>
        </div>
    </div>
    <br>

    @switch($mdaPersonnel->status)
        @case('cleared')
            <div class="cleared">
                CLEARED
            </div>
            @break
        @case('rejected')
            <div class="rejected">
                REJECTED
            </div>
            @break
        @case('pending')
            <div class="pending">
                PENDING
            </div>
            @break
        @default
            
    @endswitch
</div>
@endsection
