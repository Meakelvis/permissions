@extends('main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Special Clearances Dashboard</h1>
        <a
        href="{{ route('add') }}"
        class="
          d-none d-sm-inline-block
          btn btn-sm btn-primary
          shadow-sm
        "
        ><i class="fas fa-arrow-right fa-sm text-white-50"></i> Add Clearance</a
      >
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Cleared (Monthly) Card Example -->
        <a href="{{ route('special.cleared') }}" class="col-xl-3 col-md-6 mb-4" style="text-decoration: none;">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="
                    text-xs
                    font-weight-bold
                    text-success text-uppercase
                    mb-1
                  ">
                                Cleared
                            </div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                            </div> -->
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-thumbs-up fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Rejected (Monthly) Card Example -->
        <a href="{{ route('special.rejected') }}" class="col-xl-3 col-md-6 mb-4" style="text-decoration: none;">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="
                    text-xs
                    font-weight-bold
                    text-danger text-uppercase
                    mb-1
                  ">
                                Rejected
                            </div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                            </div> -->
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-thumbs-down fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Pending (Monthly) Card Example -->
        <a href="{{ route('special.pending') }}" class="col-xl-3 col-md-6 mb-4" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="
                    text-xs
                    font-weight-bold
                    text-primary text-uppercase
                    mb-1
                  ">
                                Pending
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <!-- <div class="
                                        h5
                                        mb-0
                                        mr-3
                                        font-weight-bold
                                        text-gray-800
                                    ">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection