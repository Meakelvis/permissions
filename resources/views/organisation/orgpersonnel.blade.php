@extends('main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    <div
        class="d-sm-flex align-items-center justify-content-between mb-4"
    >
        <h1 class="h3 mb-0 text-gray-800">{{ $organisation->entity }}</h1>

        <div class="d-flex">
            <div style="color:green; font-weight:bold">Cleared: {{ $cleared }}/{{ $submitted }}</div>
            <div class="mx-4" style="color:red; font-weight:bold">Rejected: {{ $rejected }}/{{ $submitted }}</div>
            <div style="color:blue; font-weight:bold">Pending: {{ $pending }}/{{ $submitted }}</div>
        </div>

        <div class="btn-group">
            @can('can-revert')
                <button type="button" class="btn" id="deleteSelected">
                    <i class="fas fa-trash-alt text-danger"></i>
                </button>

                {{-- revert selected --}}
                <button type="button" class="btn mx-2" id="revertSelected">
                    <i class="fas fa-history text-info"></i>
                </button>
            @endcan

            @can('can-approve')
                {{-- approve selected --}}
                <button type="button" class="btn" id="approveSelected">
                    <i class="fas fa-thumbs-up text-success"></i>
                </button>

                {{-- reject selected modal trigger --}}
                <button type="button" class="btn mr-5 ml-2" id="reasonModal" data-toggle="modal" data-target="#rejection">
                    <i class="fas fa-thumbs-down text-danger"></i>
                </button>
            @endcan
            
            @can('is-organisation')
                <a
                    href="{{ route('organisation.show', $organisation) }}"
                    class="
                        btn btn-primary
                    "
                    ><i class="fas fa-arrow-right fa-sm text-white-50"></i> Add Personnel</a
                >
            @endcan
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Your Personnel</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr id="">
                            @canany(['can-approve', 'can-revert', 'create-user'])
                                <th> 
                                    <input type="checkbox" id="checkAll" />
                                </th>
                            @endcanany
                            <th>Application No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Vehicle No Plate</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnel as $person)
                            <tr id="sid{{ $person->id }}">
                                @canany(['can-approve', 'can-revert', 'create-user'])
                                    <td>
                                        <input type="checkbox" name="ids" value="{{ $person->id }}" class="checkBoxClass"/>
                                    </td>
                                @endcanany
                                <td>
                                    <a href="{{ route('results', $person) }}">
                                        GOU/MOWT/2021/{{ 1000+$organisation->id }}/{{ \Carbon\Carbon::parse($person->created_at)->month }}/{{ 1000+$person->id }}
                                    </a>
                                </td>
                                <td>
                                    @can('add-organisation')
                                            <a href="{{ route('organisation.editPersonnel',$person) }}" class="btn">
                                                <i class="fas fa-edit text-success"></i>
                                            </a>
                                    @endcan
                                    {{ $person->name }}
                                    @can('can-approve')
                                        <br> {{ $person->phone_no }}
                                    @endcan
                                </td>
                                <td>{{ \Carbon\Carbon::parse($person->created_at)->format('d/m/Y')}} <br> 
                                    {{ \Carbon\Carbon::parse($person->created_at)->format('H:i')}}
                                </td>
                                <td>
                                    {{ $person->title }}
                                </td>
                                <td>
                                    {{ $person->vehicle_no }}
                                </td>
                                <td style="text-transform: uppercase; font-weight:bold; @if ($person->status == 'cleared') color:green; @endif @if ($person->status == 'rejected') color:red; @endif ">{{ $person->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm @error('reason_for_rejection')border border-danger @enderror " id="reason_for_rejection" name="reason_for_rejection" value="{{ old('reason_for_rejection') }}">
                            <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">
                        </div>
                        @error('reason_for_rejection')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row modal-footer">
                        <button type="button" id="rejectSelected" class="btn btn-success mx-4">Submit</button>
                        <a href="" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @canany(['can-approve', 'can-revert'])
    <script>
        $(function(e){
            $("#checkAll").click(function(){
                $(".checkBoxClass").prop("checked", $(this).prop("checked"));
            });

            // delete selected
            $("#deleteSelected").click(function(e){
                e.preventDefault();

                var allids = [];
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{route('organisation.deletePersonnel')}}",
                    type: 'DELETE',
                    data: {
                        ids: allids,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response){
                        $.each(allids, function(key,val){
                            $('#sid'+val).remove();
                        });
                        alert(response['success']);
                        location.reload();
                    }
                });
            });

            // approve selected
            $("#approveSelected").click(function(e){
                e.preventDefault();

                var allids = [];
                var category = '{{$organisation->category}}';
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{route('organisation.approveAll')}}",
                    type: 'PUT',
                    data: {
                        ids: allids,
                        org_category: category,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response){
                        alert(response['success']);
                        location.reload();
                    }
                });
            });

            // revert selected
            $("#revertSelected").click(function(e){
                e.preventDefault();

                var allids = [];
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{route('organisation.revertAll')}}",
                    type: 'PUT',
                    data: {
                        ids: allids,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response){
                        alert(response['success']);
                        location.reload();
                    }
                });
            });

            // reject selected
            $("#rejectSelected").click(function(e){
                e.preventDefault();

                var allids = [];
                let _token   = $('meta[name="csrf-token"]').attr('content');
                let reason = $('#reason_for_rejection').val();

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                console.log(reason);

                $.ajax({
                    url: "{{route('organisation.rejectAll')}}",
                    type: 'PUT',
                    data: {
                        ids: allids,
                        reason: reason,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response){
                        alert(response['success']);
                        location.reload();
                    }
                });
            });
        });
    </script>
    @endcanany
@endsection