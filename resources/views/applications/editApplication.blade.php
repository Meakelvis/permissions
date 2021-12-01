@extends('main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('applications.updateApplication', $application) }}" method="post" class="mx-auto">
        @csrf
        @method('PUT')
        <table class="table table-bordered border-dark">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Edit Application</h3></td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Name of the Applicant</strong>
                    </td>
                    <td>
                        <textarea
                            class="form-control @error('applicant_name') border border-danger @enderror "
                            id="applicant_name"
                            name="applicant_name"
                            style="
                                width: 100%;
                                height: 100%;
                                border: none;
                            "
                        >{{ $application->name }}</textarea>
                        @error('applicant_name')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td class="table-secondary" rowspan="3">
                        <strong>Travel Destination</strong>
                    </td>
                    <td class="table-secondary" rowspan="2">
                        <strong>From</strong>
                    </td>
                    <td rowspan="2">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('from') border border-danger @enderror"
                            type="text"
                            name="from"
                            id="from"
                            value="{{ $application->from }}"
                        />
                        @error('from')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Title/Occupation</strong>
                    </td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('title') border border-danger @enderror "
                            type="text"
                            name="title"
                            id="title"
                            value="{{ $application->title }}"
                        />
                        @error('title')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <!-- <td colspan="2">Larry the Bird</td> -->
                    <td class="table-secondary">
                        <strong>Date of Application</strong>
                    </td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('date') border border-danger @enderror"
                            type="date"
                            name="date"
                            id="date"
                            value="{{ $application->date_of_application }}"
                        />
                        @error('date')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td class="table-secondary"><strong>To</strong></td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('to') border border-danger @enderror"
                            type="text"
                            name="to"
                            id="to"
                            value="{{ $application->to }}"
                        />
                        @error('to')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Purpose of the Travel</strong>
                    </td>
                    <td colspan="2">
                        <select class="form-control form-control-sm @error('purpose')border border-danger @enderror " name="purpose" id="purpose">
                            <option selected>{{ $application->purpose }}</option>
                            <option value="Burial">Burial</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Medical">Medical</option>
                            <option value="Contractor">Contractor</option>
                            <option value="Government">Government</option>
                        </select>
                        @error('purpose')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td class="table-secondary">
                        <strong>Phone Number</strong>
                    </td>
                    <td>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('phone_number') border border-danger @enderror"
                            type="text"
                            name="phone_number"
                            id="phone_number"
                            value="{{ $application->phone_number }}"
                        />
                        @error('phone_number')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Validity</strong>
                    </td>
                    <td colspan="2">
                        <strong>From:</strong>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('valid_from') border border-danger @enderror"
                            type="date"
                            name="valid_from"
                            id="valid_from"
                            value="{{ $application->valid_from }}"
                        />
                        @error('valid_from')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <td colspan="2">
                        <strong>To:</strong>
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('valid_to') border border-danger @enderror"
                            type="date"
                            name="valid_to"
                            id="valid_to"
                            value="{{ $application->valid_to }}"
                        />
                        @error('valid_to')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
    
        {{-- submit and cancel buttons --}}
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-4">
                Edit Application
            </button>
            <a href="{{ route('applications') }}" class="btn btn-secondary"> Cancel </a>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
</script>
@endsection