@extends('main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">

    <table class="table table-bordered border-dark mt-4">
        <thead>
            <tr>
                <td colspan="5" class="text-center"><h4>Register Your Organization's Personnel</h4></td>
            </tr>
            <tr>
                <th>NAME</th>
                <th>TITLE</th>
                <th>VEHICLE NO</th>
                <th>NIN/PP No./ID No.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input
                        style="width: 100%; border: none"
                        class="form-control"
                        type="text"
                        name="name"
                        id="name"
                        value=""
                    />
                </td>
                <td>
                    <input
                        style="width: 100%; border: none"
                        class="form-control"
                        type="text"
                        name="title"
                        id="title"
                        value=""
                    />
                </td>
                <td>
                    <input
                        style="width: 100%; border: none"
                        class="form-control"
                        type="text"
                        name="vehicle_no"
                        id="vehicle_no"
                        value=""
                    />
                </td>
                <td>
                    <input
                        style="width: 100%; border: none"
                        class="form-control"
                        type="text"
                        name="nin"
                        id="nin"
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

    <table class="table table-bordered border-dark mt-4" id="personnel">
        <tbody>
        </tbody>
    </table>

</div>
@endsection

@section('script')
<script>
    $("#add").click((e) => {
        e.preventDefault();

        let name = $("#name").val();
        let title = $("#title").val();
        let vehicle_no = $("#vehicle_no").val();
        let nin = $("#nin").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        console.log(
            name,
            title,
            vehicle_no,
            nin, {{ $mda->id }}
        );

        /**
         * Add personnel data to db
         * */
        $.ajax({
            url: "/api/mda/personnel",
            type: "POST",
            data: {
                mda_id:{{ $mda->id }},
                name:name,
                title:title,
                vehicle_no:vehicle_no,
                nin:nin,
                _token: _token,
            },
            success:(response)=>{
                console.log(response);
            }
        });

        /**
         * Repopulate the personnel table
         * */
        $.ajax({
            url: "/api/mda/getMdaPersonnel",
            data: {
                mda_id:{{ $mda->id }}
            },
            success: (response)=>{
                // console.log(response);
                $('#personnel').empty();

                response.forEach(data => {
                    $("#personnel").append(`
                    <tr>
                        <td>
                            ${data['name']}
                        </td>
                        <td>
                            ${data['title']}
                        </td>
                        <td>
                            ${data['vehicle_no']}
                        </td>
                        <td>
                            ${data['nin']}
                        </td>
                    </tr>
                    `);
                });
            },
            error: (response)=>{
                console.log(response);
            },
        });

        $("#name").val("");
        $("#title").val("");
        $("#vehicle_no").val("");
        $("#nin").val("");
    });
</script>
@endsection