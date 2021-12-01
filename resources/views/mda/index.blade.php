@extends('main')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    <div
        class="d-sm-flex align-items-center justify-content-between mb-4"
    >
        <h1 class="h3 mb-0 text-gray-800">Ministries, Departments and Agencies</h1>
        <a
        href="{{ route('mda.add') }}"
        class="
            d-none d-sm-inline-block
            btn btn-sm btn-primary
            shadow-sm
        "
        ><i class="fas fa-arrow-right fa-sm text-white-50"></i> Add MDA</a
        >
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">MDA Clearences</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Applicant's Name</th>
                            <th>Title/Role</th>
                            <th>Category</th>
                            <th>Purpose</th>
                            <th>No. of Workers</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mdas as $mda)
                        <tr>
                            <td>
                                <a href="{{ route('mda.personnelPreview', $mda) }}">
                                    {{ $mda->entity }}
                                </a>
                            </td>
                            <td>{{ $mda->applicant_on_behalf }}</td>
                            <td>{{ $mda->title }}</td>
                            <td>{{ $mda->category }}</td>
                            <td>{{ $mda->purpose }}</td>
                            <td>{{ $mda->no_of_workers }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- add mda modal --}}
{{-- <div
    class="modal fade"
    id="addMda"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add MDA Personnel
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
                <form action="{{ route('mda.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="entity" class="col-sm-2 col-form-label">Ministry/Department/Agency/Organisation/Company</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('entity')border border-danger @enderror " id="entity" name="entity" value="{{ old('entity') }}">
                        </div>
                        @error('entity')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('category')border border-danger @enderror" id="category" name="category" value="{{ old('category') }}">
                        </div>
                        @error('category')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="applicant_on_behalf" class="col-sm-2 col-form-label">Name of Applicant(On bahelf of Entity)</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('applicant_on_behalf')border border-danger @enderror" id="applicant_on_behalf" name="applicant_on_behalf" value="{{ old('applicant_on_behalf') }}">
                        </div>
                        @error('applicant_on_behalf')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('title')border border-danger @enderror" id="title" name="title" value="{{ old('title') }}">
                        </div>
                        @error('title')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="nin" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('phone')border border-danger @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('address')border border-danger @enderror" id="address" name="address" value="{{ old('address') }}">
                        </div>
                        @error('address')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('purpose')border border-danger @enderror" id="purpose" name="purpose" value="{{ old('purpose') }}">
                        </div>
                        @error('purpose')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="no_of_workers" class="col-sm-2 col-form-label">Total No. of Workers applying for</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('no_of_workers')border border-danger @enderror" id="no_of_workers" name="no_of_workers" value="{{ old('no_of_workers') }}">
                        </div>
                        @error('no_of_workers')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row modal-footer">
                        <button type="submit" class="btn btn-success mx-4">Add MDA</button>
                        <a href="" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@endsection