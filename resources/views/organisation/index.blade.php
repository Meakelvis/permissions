@extends('main')

@section('content')
<div class="container-fluid">
    <form action="{{ route('organisation.add') }}" method="post" autocomplete="off">
        @csrf
        <table class="table table-bordered border-dark mt-4 mx-auto" style="width: 80%">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Organisation Registration</h3></td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Ministry/Department/Agency/Organisation/Company</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('entity') border border-danger @enderror"
                            type="text"
                            name="entity"
                            id="entity"
                            value="{{ old('entity') }}"/>
                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        @error('entity')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Category</strong>
                    </td>
                    <td colspan="4">
                        <select class="form-control form-control-sm @error('category')border border-danger @enderror " name="category" id="category">
                            <option selected>Select Category</option>
                            <option value="Government">Government</option>
                            <option value="Media">Media</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Medical">Medical</option>
                            <option value="Telecom">Telecom</option>
                            <option value="Construction">Construction</option>
                            <option value="Food Processors">Food Processors</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Fuel Stations">Fuel Stations</option>
                            <option value="Private Security">Private Security</option>
                            <option value="Delivery Services">Delivery Services</option>
                            <option value="Financial Institutions">Financial Institutions</option>
                            <option value="Emergency Services">Emergency Services</option>
                            <option value="Airline Operators">Airline Operators</option>
                            <option value="Restaurants">Restaurants</option>
                            <option value="Hotels">Hotels</option>
                            <option value="Cleaning and Garbage Services">Cleaning and Garbage Services</option>
                            <option value="Tours and Travel">Tours and Travel</option>
                            <option value="Supermarkets">Supermarkets</option>
                            <option value="Garages">Garages</option>
                            <option value="Insurance">Insurance</option>
                            <option value="Clearing Agents">Clearing Agents</option>
                            <option value="Education Services">Education Services</option>
                            <option value="NGOs(Non-Government Organisation)">NGOs(Non-Government Organisation)</option>
                        </select>
                        @error('category')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong
                            >Name of Applicant(On behalf of Entity)</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('name_of_applicant') border border-danger @enderror"
                            type="text"
                            name="name_of_applicant"
                            id="name_of_applicant"
                            value="{{ old('name_of_applicant') }}"/>
                        @error('name_of_applicant')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong
                            >Email</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('email') border border-danger @enderror"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"/>
                        @error('email')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Title</strong>
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('title') border border-danger @enderror"
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"/>
                        @error('title')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Phone Number</strong>
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('phone_no') border border-danger @enderror"
                            type="text"
                            name="phone_no"
                            id="phone_no"
                            value="{{ old('phone_no') }}"/>
                        @error('phone_no')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Address</strong>
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('address') border border-danger @enderror"
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address') }}"/>
                        @error('address')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Add Organisation</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection