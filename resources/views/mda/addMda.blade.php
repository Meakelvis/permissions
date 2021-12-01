@extends('main')

@section('content')
<div class="container-fluid">
    <form action="{{ route('mda.store') }}" method="post">
        @csrf
        <table class="table table-bordered border-dark mt-4 mx-auto" style="width: 80%">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>MDA Registration</h3></td>
                </tr>
                <tr>
                    <td class="table-secondary">
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
                            <option value="Essential Worker">Essential Worker</option>
                            <option value="Private Sector">Private Sector</option>
                            <option value="Tourist">Tourist</option>
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
                            >Name of Applicant(On bahelf of Entity)</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('applicant_on_behalf') border border-danger @enderror"
                            type="text"
                            name="applicant_on_behalf"
                            id="applicant_on_behalf"
                            value="{{ old('applicant_on_behalf') }}"/>
                        @error('applicant_on_behalf')
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
                            class="form-control @error('phone') border border-danger @enderror"
                            type="text"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') }}"/>
                        @error('phone')
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
                    <td class="table-secondary">
                        <strong>Purpose of Travel</strong>
                    </td>
                    <td colspan="4">
                        <select class="form-control form-control-sm @error('purpose')border border-danger @enderror " name="purpose" id="purpose">
                            <option selected>Select Purpose</option>
                            <option value="Medical Service Providers">Medical Service Providers</option>
                            <option value="Pharmaceutical Manufacturers">Pharmaceutical Manufacturers</option>
                            <option value="Farms and Veterinary Services">Farms and Veterinary Services</option>
                            <option value="Telecom Companies">Telecom Companies</option>
                            <option value="Utility Providers">Utility Providers</option>
                            <option value="Food Production Companies">Food Production Companies</option>
                            <option value="Door delivery companies">Door delivery companies</option>
                            <option value="Financial Services/Banks">Financial Services/Banks</option>
                            <option value="Private Security Companies">Private Security Companies</option>
                            <option value="Food Stores-Supermarkets, grocerys stores and food suppliers">Food Stores-Supermarkets, grocerys stores and food suppliers</option>
                            <option value="Fire Fighters">Fire Fighters</option>
                            <option value="Fuel Stations">Fuel Stations</option>
                            <option value="Manufactures and Factories">Manufactures and Factories</option>
                            <option value="Media">Media</option>
                            <option value="Construction Industry">Construction Industry</option>
                        </select>
                        @error('purpose')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary">
                        <strong>Total No. of Workers applying for</strong>
                    </td>
                    <td colspan="4"><input
                        style="width: 100%; border: none"
                        class="form-control @error('no_of_workers') border border-danger @enderror"
                        type="text"
                        name="no_of_workers"
                        id="no_of_workers"
                        value="{{ old('no_of_workers') }}"
                    />
                    @error('no_of_workers')
                        <div class="text-danger form-label form-control-sm">
                            {{ $message }}
                        </div>
                    @enderror</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Add MDA</button>
                            <a href="{{ route('mda') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection