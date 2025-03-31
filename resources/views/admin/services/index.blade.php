@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            <div class="clinic-settings-container">
                <div class="settings-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">List of Services</h4>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-add">+ Add New Service</a>
                </div>
                
                <div class="settings-body">
                    <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="show-entries">
        Show 
        <select class="entries-select">
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        entries
    </div>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('admin.services.index') }}" class="mb-3">
    <label for="animal_type">Filter by Animal Type:</label>
    <select name="animal_type" id="animal_type" class="entries-select" onchange="this.form.submit()">
        <option value="">All</option>
        <option value="Dog" {{ request('animal_type') == 'Dog' ? 'selected' : '' }}>Dog</option>
        <option value="Cat" {{ request('animal_type') == 'Cat' ? 'selected' : '' }}>Cat</option>
        <option value="Bird" {{ request('animal_type') == 'Bird' ? 'selected' : '' }}>Bird</option>
    </select>
</form>


    <div class="search-container">
        <input type="text" class="form-control search-input" placeholder="Search...">
    </div>
</div>

                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <span>#</span>
                                            <span class="sort-icon ml-1">⬍</span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <span>Date Created</span>
                                            <span class="sort-icon ml-1">⬍</span>
                                        </div>
                                    </th>
                                    <th>Service</th>
                                    <th>For</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $index => $service)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $service->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->for }}</td>
                                    <td>{{ number_format($service->price, 2) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-action dropdown-toggle" type="button" id="actionDropdown{{ $service->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionDropdown{{ $service->id }}">
                                                <a class="dropdown-item" href="{{ route('admin.services.edit', $service) }}">Edit</a>
                                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No services found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="showing-entries">
                                Showing {{ $services->firstItem() ?? 0 }} to {{ $services->lastItem() ?? 0 }} of {{ $services->total() }} entries
                            </div>
                            <div class="pagination-container">
                                {{ $services->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Main Container Styles */
    .clinic-settings-container {
        background-color: #1b2838;
        border-radius: 0;
        overflow: hidden;
    }
    
    /* Header Styles */
    .settings-header {
        background-color: #1b2838;
        padding: 20px;
        border-bottom: none;
    }
    
    .settings-header h4 {
        color: #fff;
        font-weight: 500;
    }
    
    .btn-add {
        background-color: #2196f3;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 15px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .btn-add:hover {
        background-color: #1976d2;
        color: #fff;
    }
    
    /* Body Styles */
    .settings-body {
        padding: 20px;
        background-color: #1b2838;
        color: #fff;
    }
    
    /* Table Styles */
    .table {
        color: #fff;
        background-color: transparent;
        margin-bottom: 0;
    }
    
    .table thead th {
        border-bottom: 1px solid #2a3f5a;
        border-top: none;
        color: #fff;
        font-weight: 600;
        background-color: #2a3f5a;
        padding: 12px 15px;
    }
    
    .table tbody td {
        border-top: 1px solid #2a3f5a;
        padding: 12px 15px;
        vertical-align: middle;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(42, 63, 90, 0.5);
    }
    
    /* Sort Icon */
    .sort-icon {
        color: #fff;
        opacity: 0.5;
        font-size: 12px;
    }
    
    /* Show Entries Styles */
    .show-entries, .showing-entries {
        color: #fff;
        font-size: 14px;
    }
    
    .entries-select {
        background-color: #2a3f5a;
        border: none;
        color: #fff;
        padding: 4px 8px;
        margin: 0 5px;
        border-radius: 4px;
    }
    
    /* Search Input */
    .search-input {
        background-color: #2a3f5a;
        border: none;
        color: #fff;
        border-radius: 4px;
        padding: 8px 15px;
        width: 250px;
    }
    
    .search-input:focus {
        background-color: #2a3f5a;
        border: 1px solid #3498db;
        color: #fff;
        box-shadow: none;
    }
    
    /* Action Button */
    .btn-action {
        background-color: #2a3f5a;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 5px 15px;
    }
    
    .btn-action:hover, .btn-action:focus {
        background-color: #3a4f6a;
        color: #fff;
    }
    
    .dropdown-menu {
        background-color: #2a3f5a;
        border: none;
        border-radius: 4px;
        margin-top: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .dropdown-item {
        color: #fff;
        padding: 8px 15px;
    }
    
    .dropdown-item:hover {
        background-color: #3a4f6a;
        color: #fff;
    }
    
    .text-danger {
        color: #f44336 !important;
    }
    
    /* Pagination */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-item .page-link {
        background-color: #2a3f5a;
        border: none;
        color: #fff;
        padding: 5px 10px;
        margin: 0 2px;
    }
    
    .page-item.active .page-link {
        background-color: #2196f3;
        color: #fff;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .settings-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .btn-add {
            margin-top: 10px;
        }
        
        .search-input {
            width: 100%;
        }
        
        .d-flex {
            flex-direction: column;
        }
        
        .pagination-container {
            margin-top: 15px;
        }
    }
</style>
@endsection