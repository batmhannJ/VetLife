@extends('layouts.admin')

@section('content')

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="animal_type" class="form-label">Animal Type</label>
        <input type="text" name="animal_type" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Save Category</button>
</form>

@endsection
