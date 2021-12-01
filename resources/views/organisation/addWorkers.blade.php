@extends('main')

@section('content')
<div class="container-fluid">
    <form action="{{ route('organisation.addWorkers', $organisation) }}" method="post" autocomplete="off">
        @csrf
        @method('PUT')
        <table class="table table-bordered border-dark mt-4 mx-auto" style="width: 80%">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><h3>Workers in Your Organisation</h3></td>
                </tr>
                <tr><td colspan="5" class="text-center">Kindly add the total number of workers in your organisation, MUST BE IN FIGURES
                    <br> By Submitting this form, you accept personal liability for giving false information.
                </td>
                </tr>
                <tr>
                    <td class="table-secondary" style="width: 30%">
                        <strong
                            >Number of Workers</strong
                        >
                    </td>
                    <td colspan="4">
                        <input
                            style="width: 100%; border: none"
                            class="form-control @error('total_no_of_workers') border border-danger @enderror"
                            type="number"
                            name="total_no_of_workers"
                            id="total_no_of_workers"
                            value="{{ old('total_no_of_workers') }}"/>
                            <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">
                        @error('name')
                            <div class="text-danger form-label form-control-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Add Workers</button>
                            <a href="{{ route('org.dashboard') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection