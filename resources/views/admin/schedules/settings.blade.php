@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            <div class="clinic-settings-container">
                <div class="settings-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Clinic Schedule Settings</h4>
                </div>
                
                <div class="settings-body">
                    <form method="POST" action="{{ route('admin.schedules.settings.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <h6 class="section-title">Weekly Schedule</h6>
                                <div class="weekly-checkboxes">
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="sunday" name="days[]" value="Sunday">
                                        <label for="sunday">Sunday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="monday" name="days[]" value="Monday" checked>
                                        <label for="monday">Monday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="tuesday" name="days[]" value="Tuesday" checked>
                                        <label for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="wednesday" name="days[]" value="Wednesday" checked>
                                        <label for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="thursday" name="days[]" value="Thursday" checked>
                                        <label for="thursday">Thursday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="friday" name="days[]" value="Friday" checked>
                                        <label for="friday">Friday</label>
                                    </div>
                                    <div class="custom-checkbox-container">
                                        <input type="checkbox" id="saturday" name="days[]" value="Saturday">
                                        <label for="saturday">Saturday</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-7">
                                <div class="time-section">
                                    <h6 class="section-title">Morning Time Schedule</h6>
                                    <div class="time-inputs d-flex align-items-center">
                                        <div class="time-input-container">
                                            <input type="text" class="form-control time-input" name="morning_start" value="08:00 AM">
                                            <span class="time-icon">⏱</span>
                                        </div>
                                        <span class="time-separator">to</span>
                                        <div class="time-input-container">
                                            <input type="text" class="form-control time-input" name="morning_end" value="11:00 AM">
                                            <span class="time-icon">⏱</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="time-section mt-4">
                                    <h6 class="section-title">Afternoon Time Schedule</h6>
                                    <div class="time-inputs d-flex align-items-center">
                                        <div class="time-input-container">
                                            <input type="text" class="form-control time-input" name="afternoon_start" value="01:00 PM">
                                            <span class="time-icon">⏱</span>
                                        </div>
                                        <span class="time-separator">to</span>
                                        <div class="time-input-container">
                                            <input type="text" class="form-control time-input" name="afternoon_end" value="04:00 PM">
                                            <span class="time-icon">⏱</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-update">Update</button>
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
    
    .user-badge {
        background-color: #fff;
        color: #000;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
    
    /* Body Styles */
    .settings-body {
        padding: 20px;
        background-color: #1b2838;
        color: #fff;
    }
    
    /* Section Titles */
    .section-title {
        color: #fff;
        font-weight: 500;
        margin-bottom: 20px;
    }
    
    /* Checkbox Styles */
    .weekly-checkboxes {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .custom-checkbox-container {
        display: flex;
        align-items: center;
    }
    
    .custom-checkbox-container input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin-right: 10px;
    }
    
    .custom-checkbox-container label {
        color: #fff;
        cursor: pointer;
        margin-bottom: 0;
    }
    
    /* Time Input Styles */
    .time-section {
        margin-bottom: 20px;
    }
    
    .time-inputs {
        display: flex;
        align-items: center;
    }
    
    .time-input-container {
        position: relative;
        flex: 1;
    }
    
    .time-input {
        background-color: #2a3f5a;
        border: none;
        color: #fff;
        border-radius: 4px;
        padding: 10px 35px 10px 15px;
        width: 100%;
        height: auto;
    }
    
    .time-input:focus {
        background-color: #2a3f5a;
        border: 1px solid #3498db;
        color: #fff;
        box-shadow: none;
    }
    
    .time-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
        opacity: 0.7;
    }
    
    .time-separator {
        color: #fff;
        padding: 0 20px;
    }
    
    /* Update Button */
    .btn-update {
        background-color: #2196f3;
        color: #fff;
        padding: 8px 20px;
        border: none;
        border-radius: 4px;
        font-weight: 500;
        margin-top: 10px;
    }
    
    .btn-update:hover {
        background-color: #1976d2;
        color: #fff;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .row > [class*="col-"] {
            margin-bottom: 20px;
        }
        
        .time-inputs {
            flex-direction: column;
            align-items: stretch;
        }
        
        .time-separator {
            text-align: center;
            padding: 10px 0;
        }
    }
</style>
@endsection