@extends('main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('store') }}" method="post" class="mx-auto">
        @csrf
        <table class="table table-bordered border-dark">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Permission Slip Application</h3></td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Name of the Applicant</strong>
                    </td>
                    <td>
                        <textarea
                            class="form-control @error('applicant_name') border border-danger @enderror "
                            id="applicant_name"
                            name="applicant_name"
                            style="
                                width: 100%;
                                height: 100%;
                                border: none;
                            "
                        >{{ old('applicant_name') }}</textarea>
                        @error('applicant_name')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td class="table-secondary" rowspan="3">
                        <strong>Travel Destination</strong>
                    </td>
                    <td class="table-secondary" rowspan="2">
                        <strong>From</strong>
                    </td>
                    <td rowspan="2">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('from') border border-danger @enderror"
                            type="text"
                            name="from"
                            id="from"
                            value="{{ old('from') }}"
                        />
                        @error('from')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Title/Occupation</strong>
                    </td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('title') border border-danger @enderror "
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                        />
                        @error('title')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <!-- <td colspan="2">Larry the Bird</td> -->
                    <td class="table-secondary">
                        <strong>Date of Application</strong>
                    </td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('date') border border-danger @enderror"
                            type="date"
                            name="date"
                            id="date"
                            value="{{ old('date') }}"
                        />
                        @error('date')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td class="table-secondary"><strong>To</strong></td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('to') border border-danger @enderror"
                            type="text"
                            name="to"
                            id="to"
                            value="{{ old('to') }}"
                        />
                        @error('to')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Address</strong>
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('address') border border-danger @enderror"
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address') }}"
                        />
                        @error('address')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Purpose of the Travel</strong>
                    </td>
                    <td colspan="4">
                        <select class="form-control form-control-sm @error('purpose')border border-danger @enderror " name="purpose" id="purpose">
                            <option selected>Select Purpose</option>
                            <option value="Burial">Burial</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Medical">Medical</option>
                            <option value="Contractor">Contractor</option>
                            <option value="Government">Government</option>
                        </select>
                        @error('purpose')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
    
                <!-- add occupant -->
                <table
                    class="table table-bordered border-dark"
                >
                    <tbody>
                        <tr>
                            <td class="table-secondary" colspan="3">
                                <strong
                                    >Occupants (Depending on the size of
                                    the Vehicle)</strong
                                >
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td><strong>MOTOR VEHICLE NO.</strong></td>
                            <td>
                                <strong>NAME OF DRIVER</strong>
                            </td>
                            <td><strong>NO OF OCCUPANTS</strong></td>
                        </tr>
    
                        <!-- make an ajax request HERE to loop all occupants
                            attached to the record from db -->
                        <tr id="active_row">
                            <td>
                                <input
                                    style="width: 100%; border: none"
                                    type="text"
                                    class="form-control"
                                    name="motor_vehicle_no"
                                    id="motor_vehicle_no"
                                    value=""
                                />
                            </td>
                            <td colspan="">
                                <input
                                    style="width: 100%; border: none"
                                    class="form-control"
                                    type="text"
                                    name="driver_name"
                                    id="driver_name"
                                    value=""
                                />
                            </td>
                            <td>
                                <input
                                    style="width: 100%; border: none"
                                    class="form-control"
                                    type="text"
                                    name="occupant_name"
                                    id="occupant_name"
                                    value=""
                                />
                            </td>
                            <td>
                                <div class="btn btn-success" id="add">
                                    ADD
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
    
                <!-- add occupant -->
                <table
                    id="occupants"
                    class="table table-bordered border-dark"
                >
                    <tbody>
                        <tr>
                            <td>
                                <input
                                    style="width: 100%; border: none"
                                    class="form-control"
                                    type="text"
                                    name="occupant_name"
                                    id="occupant_name"
                                    value=""
                                />
                            </td>
                            <td>
                                <input
                                    style="width: 100%; border: none"
                                    type="text"
                                    class="form-control"
                                    name="motor_vehicle_no"
                                    id="motor_vehicle_no"
                                    value=""
                                />
                            </td>
                            <td colspan="">
                                <input
                                    style="width: 100%; border: none"
                                    class="form-control"
                                    type="text"
                                    name="driver_name"
                                    id="driver_name"
                                    value=""
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
    
                {{-- validity --}}
                <table class="table table-bordered border-dark">
                    <tr>
                        <td class="table-secondary">
                            <strong>Validity</strong>
                        </td>
                        <td colspan="2">
                            <strong>From:</strong>
                            <input
                                style="width: 100%; border: none"
                                class="form-control @error('valid_from') border border-danger @enderror"
                                type="date"
                                name="valid_from"
                                id="valid_from"
                                value="{{ old('valid_from') }}"
                            />
                            @error('valid_from')
                                <div class="text-danger form-label form-control-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                        <td colspan="2">
                            <strong>To:</strong>
                            <input
                                style="width: 100%; border: none"
                                class="form-control @error('valid_to') border border-danger @enderror"
                                type="date"
                                name="valid_to"
                                id="valid_to"
                                value="{{ old('valid_to') }}"
                            />
                            @error('valid_to')
                                <div class="text-danger form-label form-control-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                </table>
            </tbody>
        </table>
    
        {{-- submit and cancel buttons --}}
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-4">
                Submit Application
            </button>
            <a href="" class="btn btn-secondary"> Cancel </a>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $("#add").click((e) => {
        e.preventDefault();

        let occupantName = $("#occupant_name").val();
        let motorVehicleNo = $("#motor_vehicle_no").val();
        let driverName = $("#driver_name").val();
        let applicantName = $("#applicant_name").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        console.log(
            occupantName,
            motorVehicleNo,
            driverName,
            applicantName
        );

        /**
         * Add occupant data to db
         *
         * Make ajax request to post data to db
         * use applicant name as foreign key constraint when getting data
         * */
        $.ajax({
            url: "/api/addOccupant",
            type: "POST",
            data: {
                applicantName: applicantName,
                occupantName: occupantName,
                motorVehicleNo: motorVehicleNo,
                driverName: driverName,
                _token: _token,
            },
            success:(response)=>{
                console.log(response);
            }
        });

        /**
         * Repopulate the occupants table
         *
         * After adding data to db,
         * make ajax call to get occupant data
         * use applicant name as search parameter
         * */
        $.ajax({
            url: "/api/getOccupants",
            data: {applicantName: applicantName},
            success: (response)=>{
                // console.log(response);
                $('#occupants').empty();

                response.forEach(data => {
                    $("#occupants").append(`
                    <tr>
                        <td>
                            ${data['motor_vehicle_no']}
                        </td>
                        <td>
                            ${data['driver_name']}
                        </td>
                        <td>
                            ${data['occupant_name']}
                        </td>
                    </tr>
                    `);
                });
            },
            error: (response)=>{
                console.log(response);
            },
        });

        $("#occupant_name").val("");
        $("#motor_vehicle_no").val("");
        $("#driver_name").val("");
    });
</script>
@endsection