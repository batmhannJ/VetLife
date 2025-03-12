@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Schedule Settings</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.schedules.saveSettings') }}">
                        @csrf
                        
                        <!-- Add your settings fields here -->
                        <div class="form-group row">
                            <label for="setting1" class="col-md-4 col-form-label text-md-right">Setting 1</label>
                            <div class="col-md-6">
                                <input id="setting1" type="text" class="form-control @error('setting1') is-invalid @enderror" name="setting1" value="{{ old('setting1', $settings->setting1 ?? '') }}">
                                @error('setting1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection