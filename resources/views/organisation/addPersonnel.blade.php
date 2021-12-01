@extends('main')

@section('content')
<div class="container-fluid">
    <form action="{{ route('organisation.addPersonnel', $organisation) }}" method="post" autocomplete="off">
        @csrf
        <table class="table table-bordered border-dark mt-4 mx-auto" style="width: 80%">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Personnel Registration</h3></td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Name</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('name') border border-danger @enderror"
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"/>
                            <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">
                        @error('name')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Title</strong
                        >
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
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Vehicle No Plate</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('vehicle_no') border border-danger @enderror"
                            type="text"
                            name="vehicle_no"
                            id="vehicle_no"
                            value="{{ old('vehicle_no') }}"/>
                        @error('vehicle_no')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Type of Vehicle</strong
                        >
                    </td>
                    <td colspan="4">
                        <select class="form-control form-control-sm @error('type_of_vehicle')border border-danger @enderror " name="type_of_vehicle" id="type_of_vehicle">
                            <option selected>Select Category</option>
                            <option value="Saloon">Saloon</option>
                            <option value="SUV">SUV</option>
                            <option value="Bus">Bus</option>
                            <option value="Omni-bus">Omni-bus</option>
                            <option value="Pick-up">Pick-up</option>
                            <option value="Station Wagon">Station Wagon</option>
                        </select>
                        @error('type_of_vehicle')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >NIN/Passport No.</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('nin') border border-danger @enderror"
                            type="text"
                            name="nin"
                            id="nin"
                            value="{{ old('nin') }}"/>
                        @error('nin')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Phone No.</strong
                        >
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
                    <td colspan="2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Add Personnel</button>
                            <a href="{{ route('organisation.personnel', $organisation) }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection