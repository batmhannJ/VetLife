@extends('layouts.admin')

@section('content')
@can('prescription_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.categories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.categories.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">List of Category (Per Name)</h5>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <div>
                    Show 
                    <select class="form-select d-inline-block mx-1" style="width: auto;">
                        <option>5</option>
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select> 
                    entries
                </div>
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
            <thead>
    <tr>
    <th>No.</th>
        <th>Date Created</th>
        <th>Animal Type</th> <!-- Bagong Column -->
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($categories as $key => $category)
    <tr>
        <td>{{ $loop->iteration }}</td> <!-- Auto-increment display number -->
        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
        <td>{{ $category->animal_type }}</td> <!-- Ipakita ang Animal Type -->
        <td>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>


            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing 1 to {{ count($categories) > 5 ? 5 : count($categories) }} of {{ count($categories) }} entries
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection