@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            <div class="clinic-settings-container">
                <div class="settings-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add New Doctor</h4>
                </div>
                
                <div class="settings-body">
                    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Doctor Name -->
                                <div class="form-group">
                                    <label for="name">Doctor Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control custom-input" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control custom-input" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control custom-input" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control custom-input" required>
                                </div>
                                
                                <!-- Designation -->
                                <div class="form-group">
                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" id="designation" name="designation" class="form-control custom-input" value="{{ old('designation') }}" required>
                                    @error('designation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Degree -->
                                <div class="form-group">
                                    <label for="degree">Degree <span class="text-danger">*</span></label>
                                    <input type="text" id="degree" name="degree" class="form-control custom-input" value="{{ old('degree') }}" required>
                                    @error('degree')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department">Department <span class="text-danger">*</span></label>
                                    <input type="text" id="department" name="department" class="form-control custom-input" value="{{ old('department') }}" required>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <!-- Birth Date -->
                                <div class="form-group">
                                    <label for="birth_date">Birth Date <span class="text-danger">*</span></label>
                                    <input type="date" id="birth_date" name="birth_date" class="form-control custom-input" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Specialist -->
                                <div class="form-group">
                                    <label for="specialist">Specialist <span class="text-danger">*</span></label>
                                    <input type="text" id="specialist" name="specialist" class="form-control custom-input" value="{{ old('specialist') }}" required>
                                    @error('specialist')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Doctor Experience -->
                                <div class="form-group">
                                    <label for="experience">Doctor Experience (years) <span class="text-danger">*</span></label>
                                    <input type="number" id="experience" name="experience" class="form-control custom-input" value="{{ old('experience') }}" required min="0">
                                    @error('experience')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Service Place -->
                                <div class="form-group">
                                    <label for="service_place">Service Place <span class="text-danger">*</span></label>
                                    <input type="text" id="service_place" name="service_place" class="form-control custom-input" value="{{ old('service_place') }}" required>
                                    @error('service_place')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control custom-input" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea id="address" name="address" class="form-control custom-input" rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Photo -->
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <div class="custom-file-container">
                                        <input type="file" id="photo" name="photo" class="custom-file-input" accept="image/*" onchange="showPreview(this)">
                                        <label class="custom-file-label" for="photo">Choose file</label>
                                    </div>
                                    <div class="mt-2 photo-preview-container d-none">
                                        <img id="photo-preview" src="#" alt="Photo Preview" class="img-thumbnail">
                                        <button type="button" class="btn btn-sm btn-remove-photo" onclick="removePreview()">×</button>
                                    </div>
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4 text-right">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-cancel mr-2">Cancel</a>
                            <button type="submit" class="btn btn-save">Save Doctor</button>
                        </div>
                    </form>
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
        /*background-color: #1b2838;*/
        background-color: #fff;
        border-radius: 0;
        overflow: hidden;
    }
    
    /* Header Styles */
    .settings-header {
        background-color: #fff;
        padding: 20px;
        border-bottom: none;
    }
    
    .settings-header h4 {
        color: #000;
        font-weight: 500;
    }
    
    /* Body Styles */
    .settings-body {
        padding: 20px;
        background-color: #fff;
        color: #fff;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        color: #000;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    
    .custom-input {
        background-color: #2a3f5a;
        border: none;
        color: #fff;
        border-radius: 4px;
        padding: 10px 15px;
        width: 100%;
        height: auto;
    }
    
    .custom-input:focus {
        background-color: #2a3f5a;
        border: 1px solid #3498db;
        color: #fff;
        box-shadow: none;
    }
    
    /* File Input Styles */
    .custom-file-container {
        position: relative;
    }
    
    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin: 0;
        opacity: 0;
    }
    
    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: 40px;
        padding: 10px 15px;
        font-weight: 400;
        line-height: 1.5;
        color: #fff;
        background-color: #2a3f5a;
        border: none;
        border-radius: 4px;
        display: flex;
        align-items: center;
    }
    
    .custom-file-label::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: 40px;
        padding: 10px 15px;
        line-height: 1.5;
        color: #fff;
        content: "Browse";
        background-color: #1976d2;
        border-left: inherit;
        border-radius: 0 4px 4px 0;
    }
    
    /* Photo Preview Styles */
    .photo-preview-container {
        position: relative;
        display: inline-block;
        max-width: 150px;
    }
    
    .btn-remove-photo {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #f44336;
        color: #fff;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        padding: 0;
        line-height: 25px;
        font-size: 14px;
    }
    
    /* Button Styles */
    .btn-save {
        background-color: #2196f3;
        color: #fff;
        padding: 8px 25px;
        border: none;
        border-radius: 4px;
        font-weight: 500;
    }
    
    .btn-save:hover {
        background-color: #1976d2;
        color: #fff;
    }
    
    .btn-cancel {
        background-color: #455a74;
        color: #fff;
        padding: 8px 25px;
        border: none;
        border-radius: 4px;
        font-weight: 500;
    }
    
    .btn-cancel:hover {
        background-color: #36465c;
        color: #fff;
    }
    
    /* Text styles */
    .text-danger {
        color: #f44336 !important;
    }
    
    /* Helpers */
    .d-none {
        display: none !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .row > [class*="col-"] {
            margin-bottom: 20px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function showPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#photo-preview').attr('src', e.target.result);
                $('.photo-preview-container').removeClass('d-none');
                $('.custom-file-label').text(input.files[0].name);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removePreview() {
        $('#photo').val('');
        $('#photo-preview').attr('src', '#');
        $('.photo-preview-container').addClass('d-none');
        $('.custom-file-label').text('Choose file');
    }
</script>
@endsection