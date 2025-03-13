@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.patients.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Patient Personal Information Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <label for="last_name">{{ trans('cruds.patient.fields.last_name') }}*</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($patient) ? $patient->last_name : '') }}" required>
                                @if($errors->has('last_name'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('last_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                <label for="first_name">{{ trans('cruds.patient.fields.first_name') }}*</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($patient) ? $patient->first_name : '') }}" required>
                                @if($errors->has('first_name'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('first_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Gender -->
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ trans('cruds.patient.fields.gender') }}*</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="" disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Patient::GENDER_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('gender', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('gender'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('gender') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Date of Birth -->
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                                <label for="dob">{{ trans('cruds.patient.fields.dob') }}*</label>
                                <input type="text" id="dob" name="dob" class="form-control date" value="{{ old('dob', isset($patient) ? $patient->dob : '') }}" required>
                                @if($errors->has('dob'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('dob') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Age (Auto-calculated) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" id="age" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($patient) ? $patient->email : '') }}">
                                @if($errors->has('email'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($patient) ? $patient->phone : '') }}">
                                @if($errors->has('phone'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('phone') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ trans('cruds.patient.fields.address') }}*</label>
                                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($patient) ? $patient->address : '') }}" required>
                                @if($errors->has('address'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('address') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Zip Code -->
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" id="pin_code" name="pin_code" class="form-control" value="{{ old('pin_code', isset($patient) ? $patient->pin_code : '') }}">
                                @if($errors->has('pin_code'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('pin_code') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Blood Type -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('blood_group') ? 'has-error' : '' }}">
                                <label for="blood_group">{{ trans('cruds.patient.fields.blood_group') }}</label>
                                <select id="blood_group" name="blood_group" class="form-control">
                                    <option value="" disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Patient::BLOOD_GROUP_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('blood_group', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('blood_group'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('blood_group') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Photo -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                <label for="photo">{{ trans('cruds.patient.fields.photo') }}</label>
                                <div class="needsclick dropzone" id="photo-dropzone">
                                </div>
                                @if($errors->has('photo'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('photo') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Emergency Contact</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Emergency Contact Name -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('emergency_contact_name') ? 'has-error' : '' }}">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" id="emergency_contact_name" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', isset($patient) ? $patient->emergency_contact_name : '') }}">
                                @if($errors->has('emergency_contact_name'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('emergency_contact_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Emergency Contact Relationship -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('emergency_contact_relationship') ? 'has-error' : '' }}">
                                <label for="emergency_contact_relationship">Relationship</label>
                                <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" class="form-control" value="{{ old('emergency_contact_relationship', isset($patient) ? $patient->emergency_contact_relationship : '') }}">
                                @if($errors->has('emergency_contact_relationship'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('emergency_contact_relationship') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Emergency Contact Phone -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('emergency_contact_phone') ? 'has-error' : '' }}">
                                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                <input type="text" id="emergency_contact_phone" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone', isset($patient) ? $patient->emergency_contact_phone : '') }}">
                                @if($errors->has('emergency_contact_phone'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('emergency_contact_phone') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Emergency Contact Address -->
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('emergency_contact_address') ? 'has-error' : '' }}">
                                <label for="emergency_contact_address">Emergency Contact Address</label>
                                <input type="text" id="emergency_contact_address" name="emergency_contact_address" class="form-control" value="{{ old('emergency_contact_address', isset($patient) ? $patient->emergency_contact_address : '') }}">
                                @if($errors->has('emergency_contact_address'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('emergency_contact_address') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <input class="btn btn-primary" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.patients.storeMedia') }}',
        maxFilesize: 4, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 4,
            width: 600,
            height: 600
        },
        success: function (file, response) {
            $('form').find('input[name="photo"]').remove()
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($patient) && $patient->photo)
            var file = {!! json_encode($patient->photo) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, '{{ $patient->photo->getUrl('thumb') }}')
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    };

    // Calculate age based on date of birth
    $(document).ready(function() {
        // Function to calculate age from date of birth
        function calculateAge(birthDate) {
            const today = new Date();
            const birth = new Date(birthDate);
            let age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();
            
            // If birthday hasn't occurred yet this year, subtract one year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                age--;
            }
            
            return age;
        }
        
        // Update age field when date of birth changes
        $('#dob').change(function() {
            const dob = $(this).val();
            if (dob) {
                const age = calculateAge(dob);
                $('#age').val(age);
            } else {
                $('#age').val('');
            }
        });
        
        // If dob is already filled (in case of edit), calculate age on page load
        if ($('#dob').val()) {
            const age = calculateAge($('#dob').val());
            $('#age').val(age);
        }
    });
</script>
@endsection