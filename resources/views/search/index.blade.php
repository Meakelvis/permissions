@extends('base')

@section('content')

<a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>

<form class="d-flex my-4" action="{{ route('search') }}" method="GET" autocomplete="off">
    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Special Clearences</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Application No</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>From - To</th>
                        <th>Issuer</th>
                        <th>District of Issuance</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($results)
                        @foreach ($results as $result)
                            <tr>
                                <td>
                                    <a href="{{ route('results', $result) }}">
                                        {{ $result->id }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($result->date_of_application)->format('d/m/Y')}}</td>
                                <td>
                                    <a href="{{ route('results', $result) }}">
                                        {{ $result->applicant_name }}
                                    </a>
                                </td>
                                <td>{{ $result->from }} - {{ $result->to }}</td>
                                <td>{{ $result->user->name }}</td>
                                <td>{{ $result->user->district }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr></tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

