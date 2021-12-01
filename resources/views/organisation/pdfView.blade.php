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
                right: 35;
                top:20;
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
                right: 35;
                top:20;
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
                right: 35;
                top:20;
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
        <div class="header">
            <img src="{{ public_path('img/coat.png') }}" alt="" style="width: 120px; margin-left: 300px">
            <h2 style="margin-top: -20px; text-align: center;">Ministry of Works and Transport</h2>
        </div>
        <div class="container-fluid">
            <p style="color: red"><strong>GOU/MOWT/2021/{{ 1000+$organisationPersonnel->organisation->id }}/{{ \Carbon\Carbon::parse($organisationPersonnel->date_of_approval)->month }}/{{ 1000+$organisationPersonnel->id }}</strong></p>
            <p style="margin-top: -15px">{{ \Carbon\Carbon::parse($organisationPersonnel->date_of_approval)->format('d/m/Y')}}</p>
            <h3 style="font-weight: bold; text-align:center;text-transform: uppercase;">CATEGORY: {{ $organisationPersonnel->organisation->category }}</h3>
            <hr>
            <p style="text-transform: uppercase;">{{ $organisationPersonnel->name }}</p>
            <p style="margin-top: -15px; text-transform: uppercase;">{{ $organisationPersonnel->organisation->entity }}</p>
            <p style="margin-top: -15px; text-transform: uppercase">{{ $organisationPersonnel->title }}</p>

            <p style="font-weight: bold; margin-top:2rem">
                CLEARANCE TO TRAVEL DURING THE CORONA VIRUS QUARANTINE PERIOD LOCKDOWN WITHIN GREATER KAMPALA METROPOLITAN AREA
            </p>

            <table class="table table-bordered border-dark mt-4">
                <tbody>
                    <tr>
                        <td class="title">
                            <strong>Name of the Applicant</strong>
                        </td>
                        <td>{{ $organisationPersonnel->name }}</td>
                        <td class="title" rowspan="3">
                            <strong>Travel Destination</strong>
                        </td>
                        <td class=" title" rowspan="2">
                            <strong>From</strong>
                        </td>
                        <td rowspan="2">HOME</td>
                    </tr>
                    <tr>
                        <td class=" title"><strong>Title</strong></td>
                        <td>{{ $organisationPersonnel->title }}</td>
                    </tr>
                    <tr>
                        <!-- <td colspan="2">Larry the Bird</td> -->
                        <td class=" title">
                            <strong>Date of Application</strong>
                        </td>
                        <td>
                            {{
                            \Carbon\Carbon::parse($organisationPersonnel->created_at)->format('d/m/Y')}}
                        </td>
                        <td class=" title"><strong>To</strong></td>
                        <td>WORK</td>
                    </tr>
                    <tr>
                        <td class=" title">
                            <strong>Organisation</strong>
                        </td>
                        <td colspan="4">{{ $organisationPersonnel->organisation->entity }}</td>
                    </tr>
                    <tr>
                        <td class=" title">
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
                        <td class=" title" colspan="3">
                            <strong
                                >Occupants (Depending on the size of the
                                Vehicle)</strong
                            >
                        </td>
                        <td colspan="2">{{ $organisationPersonnel->occupants }}</td>
                    </tr>
                    <tr>
                        <td class=" title" colspan="2">
                            <strong>Validity</strong>
                        </td>
                        <td colspan="3">
                            {{ \Carbon\Carbon::parse($organisationPersonnel->date_of_approval)->format('d/m/Y')}} - {{ $finalDate }}
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="5" style="text-align: center; color:red; font-size:large">
                            <strong>
                                @if ($organisationPersonnel->organisation->category=='Works Special')
                                    EXEMPTED FROM CURFEW
                                @endif
                            </strong>
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
                            <li>Unauthorized passengers in the above vehicle are strictly forbidden.</li>
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="footer">
                <div class="signature" style="margin-top: 30px">
                    <img src="{{ public_path('img/sign.jpg') }}" style="width: 100px">
                    {{-- {{ public_path('img/sign.jpg') }} --}}
                </div>
                <div class="text">
                    <p style="margin-top: -2px"><strong>PERMANENT SECRETARY</strong></p>
                    <p style="margin-top: -12px"><strong>MINISTRY OF WORKS AND TRANSPORT</strong></p>
                </div>
                <div class="qrcode">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(100)->generate(Request::url())) !!}" />
                </div>
            </div>
            <br>

            @switch($organisationPersonnel->status)
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
