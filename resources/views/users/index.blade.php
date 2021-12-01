@extends('main')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Application History</h1> --}}
    @can('create-user')
        <div
            class="d-sm-flex align-items-center justify-content-between mb-4"
        >
            <h1 class="h3 mb-0 text-gray-800">System Users</h1>
            <a
                href=""
                class="
                    d-none d-sm-inline-block
                    btn btn-sm btn-primary
                    shadow-sm
                "
                data-toggle="modal"
                data-target="#addUserModal"
            ><i class="fas fa-user-plus fa-sm text-white-50"></i> Add User</a>
        </div>
    @endcan

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recently added Users</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- add user modal --}}
<div
    class="modal fade"
    id="addUserModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add New User
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
                <form action="{{ route('auth.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm @error('name')border border-danger @enderror " id="name" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="role" class="col-sm-2 col-form-label">User Role</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm @error('role')border border-danger @enderror " name="role" id="role">
                                <option selected>Select Role</option>
                                <option value="4">Organisation</option>
                                <option value="3">General User</option>
                                <option value="2">Administrator</option>
                                <option value="1">Super User</option>
                                <option value="12">Revert</option>
                                <option value="13">Approval</option>
                            </select>
                        </div>
                        @error('role')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control form-control-sm @error('password')border border-danger @enderror" id="password">
                        </div>
                        @error('password')
                          <div class="text-danger text-sm">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3 row modal-footer">
                        <button type="submit" class="btn btn-success mx-4">Register User</button>
                        <a href="" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection