@extends('main')

@section('content')
<div class="container-fluid">

    <form action="{{ route('deleteMotorcycles') }}"  method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">
            Delete Bodas
        </button>
    </form>
</div>
@endsection