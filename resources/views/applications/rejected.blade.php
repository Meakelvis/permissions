@extends('main')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rejected Special Clearances</h1>

        <div class="btn-group">
            @canany(['can-revert', 'add-organisation'])
                <button type="button" class="btn" id="deleteSelected">
                    <i class="fas fa-trash-alt text-danger"></i>
                </button>
            @endcanany

            @canany(['can-revert'])
                {{-- revert selected --}}
                <button type="button" class="btn mx-2" id="revertSelected">
                    <i class="fas fa-history text-info"></i>
                </button>
                
                {{-- approve selected --}}
                <button type="button" class="btn mr-5 ml-2" id="approveSelected">
                    <i class="fas fa-thumbs-up text-success"></i>
                </button>
            @endcanany
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rejected Applications</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr id="">
                            @canany(['can-revert', 'create-user', 'add-organisation'])
                                <th> 
                                    <input type="checkbox" id="checkAll" />
                                </th>
                            @endcanany
                            <th>Application No</th>
                            <th>Name of Applicant</th>
                            <th>Date of Application</th>
                            <th>Purpose</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejected as $record)
                        <tr id="sid{{ $record->id }}">
                            @canany(['can-revert', 'create-user', 'add-organisation'])
                                <td>
                                    <input type="checkbox" name="ids" value="{{ $record->id }}" class="checkBoxClass"/>
                                </td>
                            @endcanany
                            <td>
                                <a href="{{ route('applications.results', $record) }}">
                                    GOU/MOWT/2021/{{ \Carbon\Carbon::parse($record->created_at)->month }}/{{ 1000+$record->id }}
                                </a>
                            </td>
                            <td>
                                @canany(['add-organisation', 'can-revert', 'create-user'])
                                        <a href="{{ route('applications.editApplication',$record) }}" class="btn">
                                            <i class="fas fa-edit text-success"></i>
                                        </a>
                                        <a href="{{ route('applications.addVehicles',$record) }}" class="btn">
                                            <i class="fas fa-car text-warning"></i>
                                        </a>
                                @endcanany
                                {{ $record->name }}</td>
                            <td>{{ $record->date_of_application }}</td>
                            <td>{{ $record->purpose }}</td>
                            <td>{{ $record->valid_from }}</td>
                            <td>{{ $record->valid_to }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
    @canany(['can-revert', 'create-user'])
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
                    url: "{{route('applications.deleteAll')}}",
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
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{route('applications.approveAll')}}",
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

            // revert selected
            $("#revertSelected").click(function(e){
                e.preventDefault();

                var allids = [];
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url: "{{route('applications.revertAll')}}",
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
        });
    </script>
    @endcanany
@endsection