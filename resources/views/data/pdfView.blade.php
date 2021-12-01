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
                top:30;
                transform: rotate(-15deg);
                color: white;
                background-color: green;
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
                top:30;
                transform: rotate(-15deg);
                color: white;
                background-color: red;
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
                top:30;
                transform: rotate(-15deg);
                color: white;
                background-color:black;
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
            <div class="header">
                <img src="{{ public_path('img/coat.png') }}" alt="" style="width: 120px; margin-left: 300px">
                <h2 style="margin-top: -20px; text-align: center;">Ministry of Works and Transport</h2>
            </div>

            <p style="color: red"><strong>GOU/2021/MOWT/{{ now()->month }}/{{ 1000+$data->id }}</strong></p>
            <p style="margin-top: -15px">{{ date('d-m-Y') }}</p>
            <h4 style="font-weight: bold; text-align:center;  font-size:large">SPECIAL CLEARANCE: {{ Str::upper($data->purpose_of_travel) }}</h4>
            <h3 style="text-align: center; margin-top:-20px; color:red;">TO BE USED OUT OF THE GREATER KAMPALA METROPOLITAN AREA</h3>
            <hr>
            <p style="font-weight: bold">LETTER OF EXEMPTION AND CLEARANCE TO TRAVEL DURING THE CORONA VIRUS QUARANTINE PERIOD LOCKDOWN</p>

            <table class="table table-bordered border-dark mt-4">
                <tbody>
                    <tr>
                        <td class="title">
                            <strong>Name of the Applicant</strong>
                        </td>
                        <td class="title">{{ $data->applicant_name }}</td>
                        <td class="title" rowspan="3">
                            <strong>Travel Destination</strong>
                        </td>
                        <td class=" title" rowspan="2">
                            <strong>From</strong>
                        </td>
                        <td rowspan="2" class="title">{{ $data->from }}</td>
                    </tr>
                    <tr>
                        <td class=" title"><strong>Title/Occupation</strong></td>
                        <td class="title">{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <!-- <td colspan="2">Larry the Bird</td> -->
                        <td class=" title">
                            <strong>Date of Application</strong>
                        </td>
                        <td class="title">
                            {{
                            \Carbon\Carbon::parse($data->date_of_application)->format('d/m/Y')}}
                        </td>
                        <td class=" title"><strong>To</strong></td>
                        <td class="title">{{ $data->to }}</td>
                    </tr>
                    <tr>
                        <td class=" title">
                            <strong>Address</strong>
                        </td>
                        <td class="title" colspan="4">{{ $data->address }}</td>
                    </tr>
                    <tr>
                        <td class=" title">
                            <strong>Purpose of the Travel</strong>
                        </td>
                        <td class="title" colspan="4">{{ $data->purpose_of_travel }}</td>
                    </tr>
                    <tr>
                        <td class=" title" colspan="3">
                            <strong
                                >Occupants (Depending on the size of the
                                Vehicle)</strong
                            >
                        </td>
                        <td class="title" colspan="2"></td>
                    </tr>
                    <tr>
                        <td class="title"><strong>NO.</strong></td>
                        <td class="title"><strong>MOTOR VEHICLE NO.</strong></td>
                        <td class="title" colspan="2"><strong>NAME OF DRIVER</strong></td>
                        <td class="title"><strong>NO OF OCCUPANTS</strong></td>
                    </tr>
                    @foreach ($occupants as $key=>$occupant)
                    <tr>
                        <td class="title">{{ $key+1 }}</td>
                        <td class="title">{{ $occupant->motor_vehicle_no }}</td>
                        <td class="title" colspan="2">{{ $occupant->driver_name }}</td>
                        <td class="title">{{ $occupant->occupant_name }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class=" title" colspan="2">
                            <strong>Validity</strong>
                        </td>
                        <td class="title" colspan="3">
                            {{
                            \Carbon\Carbon::parse($data->valid_from)->format('d/m/Y')}}
                            - {{
                            \Carbon\Carbon::parse($data->valid_to)->format('d/m/Y')}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="title">
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
                                    The permission does not extend beyond the
                                    designed area specified in this letter.
                                </li>
                                <li>
                                    You are advised to keep this letter and your personal identification details in the vehicle at all times.
                                </li>
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div>
                <h3>This form is valid for only {{ $validity }} days.</h3>
            </div>

            <div class="footer">
                <img src="{{ public_path('img/sign.jpg') }}" style="width: 100px; margin-top:10px;">
                <div class="text" style="margin-top:-15px;">
                    <p style="margin-bottom:-10px">Bageya Waiswa</p>
                    <p><strong>PERMANENT SECRETARY,
                        <br> MINISTRY OF WORKS AND TRANSPORT</strong></p>
                </div>
                <div class="qrcode">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(100)->generate(Request::url())) !!}" />
                </div>
            </div>
            <br>

            @switch($data->status)
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
