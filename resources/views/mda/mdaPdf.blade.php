<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link
            href="bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous"
        />
        {{-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous"
        /> --}}

        <title>Special Clearance</title>
        <style>
            body{
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: small;
            }

            table{
                border: 0.5px solid black;
                border-spacing: 0;
                width:100%;
            }

            table tr td{
                border: 0.5px solid black;
            }

            .title{
                background-color:rgb(189, 179, 179, .5);
                /* rgba(255, 255, 128, .5); */
            }

            .footer{
                position: relative;
            }

            .qrcode{
                position: absolute;
                right: 0;
                top: 10;
            }

            .cleared{
                position: absolute;
                right: 40;
                top:40;
                transform: rotate(-15deg);
                color: green;
                text-align: center;
                font-size: x-large;
                font-weight: bold;
                padding: 0.5rem 2.5rem;
                width: 3rem;
                height:auto;
                border: 4px solid green;
            }

            .rejected{
                position: absolute;
                right: 40;
                top:40;
                transform: rotate(-15deg);
                color: red;
                text-align: center;
                font-size: x-large;
                font-weight: bold;
                padding: 0.5rem 2.5rem;
                width: 3rem;
                height:auto;
                border: 4px solid red;
            }

            .pending{
                position: absolute;
                right: 40;
                top:40;
                transform: rotate(-15deg);
                color: black;
                text-align: center;
                font-size: x-large;
                font-weight: bold;
                padding: 0.5rem 2.5rem;
                width: 3rem;
                height:auto;
                border: 4px solid black;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <p style="color: red"><strong>GOU/2021/MOWT/MDA/{{ now()->month }}/{{ 1000+$mda->id }}</strong></p>
            <p style="margin-top: -15px">{{ date('d-m-Y') }}</p>
            <h4 style="font-weight: bold; text-align:center">SPECIAL CLEARANCE</h4>
            <hr>
            <p>{{ $mda->name }}</p>
            {{-- <p style="margin-top: -15px">{{ $mda->address }}</p> --}}
            {{-- <p style="margin-top: -15px">{{ $mda->from }}</p> --}}

            {{-- <p style="font-weight: bold">CLEARANCE TO TRAVEL TO {{ Str::upper($mda->to) }} FOR {{ Str::upper($mda->purpose_of_travel) }} DURING THE CORONA VIRUS QUARANTINE PERIOD LOCKDOWN</p> --}}

            <table class="table table-bordered border-dark mt-4">
                <tbody>
                    <tr>
                        <td class="title">
                            <strong>Name of the Applicant</strong>
                        </td>
                        <td>{{ $mda->name }}</td>
                        <td class="title" rowspan="3">
                            <strong>Travel Destination</strong>
                        </td>
                        <td rowspan="3">
                            <strong>RESTRICTED TO ONLY TRAVEL FROM HOME TO OFFICE</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class=" title"><strong>Title</strong></td>
                        <td>{{ $mda->title }}</td>
                    </tr>
                    <tr>
                        <!-- <td colspan="2">Larry the Bird</td> -->
                        <td class=" title">
                            <strong>Date of Application</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($mda->created_at)->format('d/m/Y') }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <td class=" title">
                            <strong>Address</strong>
                        </td>
                        <td colspan="4">{{ $mda->address }}</td>
                    </tr> --}}
                    <tr>
                        <td class=" title">
                            <strong>Purpose of the Travel</strong>
                        </td>
                        <td colspan="4">{{ $mda->purpose }}</td>
                    </tr>
                    <tr>
                        <td class=" title">
                            <strong>Vehicle No.</strong>
                        </td>
                        <td colspan="4">{{ $mda->vehicle_no }}</td>
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
                        <td>{{ $mda->vehicle_no }}</td>
                        <td colspan="2">{{ $mda->name }}</td>
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
                <div class="qrcode">
                    <img src="mda:image/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(100)->generate(Request::url())) !!}" />
                </div>
            </div>
            <br>

            @switch($mda->status)
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
        
        <script
            src="bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
