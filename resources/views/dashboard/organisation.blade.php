@extends('main')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    <div
        class="d-sm-flex align-items-center justify-content-between mb-4"
    >
        <h1 class="h3 mb-0 text-gray-800">Organisation Dashboard</h1>
        @can('create-user')
            <span
                data-href="/csv"
                id="export"
                onclick="exportTasks(event.target);"
                class="
                    d-none d-sm-inline-block
                    btn btn-sm btn-primary
                    shadow-sm
                "
                ><i class="fas fa-arrow-right fa-sm text-white-50"></i> Export CSV</span>

        @endcan
        @can('add-organisation')
            <a
                href="{{ route('organisation.add') }}"
                class="
                    d-none d-sm-inline-block
                    btn btn-sm btn-primary
                    shadow-sm
                "
                ><i class="fas fa-arrow-right fa-sm text-white-50"></i> Add Organisation</a
            >
        @endcan
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Your Organisations</h6>
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
                        @can('is-organisation')
                            @foreach ($organisation as $data)
                                <tr>
                                    <td>
                                        <a href="{{ route('organisation.personnel', $data) }}">
                                            GOU/MOWT/2021/{{ \Carbon\Carbon::parse($data->created_at)->month }}/{{ 1000+$data->id }}
                                        </a>
                                    </td>
                                    <td>{{ strtoupper($data->entity) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        {{ $data->name_of_applicant }}
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
                        @endcan

                        @canany(['add-organisation', 'can-approve', 'can-revert'])
                            @foreach ($allOrganisations as $data)
                                <tr>
                                    <td>
                                        <a href="{{ route('organisation.personnel', $data) }}">
                                            GOU/MOWT/2021/{{ \Carbon\Carbon::parse($data->created_at)->month }}/{{ 1000+$data->id }}
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
                                {!! $allOrganisations->links() !!}
                            </div> --}}
                        @endcanany
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }
    </script>
@endsection

@endsection