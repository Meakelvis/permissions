@extends('main')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    <div
        class="d-sm-flex align-items-center justify-content-between mb-4"
    >
        <h1 class="h3 mb-0 text-gray-800">Categories Dashboard</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Construction Organisations</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Application No</th>
                            <th>Entity</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Clearance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @canany(['add-organisation', 'can-approve', 'can-revert'])
                            @foreach ($organisations as $data)
                                <tr>
                                    <td>
                                        <a href="{{ route('organisation.personnel', $data) }}">
                                            GOU/MOWT/2021/{{ now()->month }}/{{ 1000+$data->id }}
                                        </a>
                                    </td>
                                    <td>
                                        @can('can-revert')
                                            <form action="{{ route('organisation.delete', $data) }}"  method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" type="submit">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
                                            </form>
                                        @endcan {{ strtoupper($data->entity) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}} <br>
                                        {{ \Carbon\Carbon::parse($data->created_at)->format('H:i')}}
                                    </td>
                                    <td>
                                        {{ $data->name_of_applicant }} <br> {{ $data->phone_no }}
                                    </td>
                                    <td>
                                        <p style="color:green; font-weight:bold">
                                            {{ \App\Models\OrganisationPersonnel::where('organisation_id', $data->id)->where('status','cleared')->count() }}/{{ \App\Models\OrganisationPersonnel::where('organisation_id', $data->id)->count() }} Cleared
                                        </p>
                                        <p style="color:red; font-weight:bold; margin-top:-15px">
                                            {{ \App\Models\OrganisationPersonnel::where('organisation_id', $data->id)->where('status','rejected')->count() }}/{{ \App\Models\OrganisationPersonnel::where('organisation_id', $data->id)->count() }} Rejected
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <div class="d-flex justify-content-center">
                                {!! $organisations->links() !!}
                            </div> --}}
                        @endcanany
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection