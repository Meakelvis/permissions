@extends('auth.layout')

@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    @include('includes.messages')
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ministry of Works and Transport</h1>
                                    <h5 class="text-gray-900 mb-4">Clearance Application System</h5>
                                </div>
                                
                                <form class="user" action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email')border border-danger @enderror"
                                            id="email" name="email"
                                            placeholder="Enter Email Address...">
                                            @error('email')
                                                <div class="text-danger text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password')border border-danger @enderror"
                                            id="password" name="password" placeholder="Password">
                                            @error('password')
                                                <div class="text-danger text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection