@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.patients.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('cruds.patient.fields.first_name') }}*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($patient) ? $patient->first_name : '') }}" required>
                @if($errors->has('first_name'))
                    <p class="help-block">
                        {{ $errors->first('first_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.first_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('cruds.patient.fields.last_name') }}*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($patient) ? $patient->last_name : '') }}" required>
                @if($errors->has('last_name'))
                    <p class="help-block">
                        {{ $errors->first('last_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.last_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('pin_code') ? 'has-error' : '' }}">
                <label for="pin_code">{{ trans('cruds.patient.fields.pin_code') }}*</label>
                <input type="text" id="pin_code" name="pin_code" class="form-control" value="{{ old('pin_code', isset($patient) ? $patient->pin_code : '') }}" required>
                @if($errors->has('pin_code'))
                    <p class="help-block">
                        {{ $errors->first('pin_code') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.pin_code_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($patient) ? $patient->phone : '') }}">                @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('phone') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                <label for="gender">{{ trans('cruds.patient.fields.gender') }}*</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="" disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Patient::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <p class="help-block">
                        {{ $errors->first('gender') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('cruds.patient.fields.address') }}*</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($patient) ? $patient->address : '') }}" required>
                @if($errors->has('address'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.address_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($patient) ? $patient->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('blood_group') ? 'has-error' : '' }}">
                <label for="blood_group">{{ trans('cruds.patient.fields.blood_group') }}</label>
                <select id="blood_group" name="blood_group" class="form-control">
                    <option value="" disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Patient::BLOOD_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('blood_group', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('blood_group'))
                    <p class="help-block">
                        {{ $errors->first('blood_group') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                <label for="dob">{{ trans('cruds.patient.fields.dob') }}*</label>
                <input type="text" id="dob" name="dob" class="form-control date" value="{{ old('dob', isset($patient) ? $patient->dob : '') }}" required>
                @if($errors->has('dob'))
                    <p class="help-block">
                        {{ $errors->first('dob') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.dob_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('office') ? 'has-error' : '' }}">
                <label for="office">{{ trans('cruds.patient.fields.office') }}*</label>
                <select id="office" name="office" class="form-control" required>
                    <option value="" disabled {{ old('office', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Patient::OFFICE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('office', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('office'))
                    <p class="help-block">
                        {{ $errors->first('office') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('job_type') ? 'has-error' : '' }}">
                <label for="job_type">{{ trans('cruds.patient.fields.job_type') }}*</label>
                <select id="job_type" name="job_type" class="form-control" required>
                    <option value="" disabled {{ old('job_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Patient::JOB_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_type', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_type'))
                    <p class="help-block">
                        {{ $errors->first('job_type') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                <label for="department">{{ trans('cruds.patient.fields.department') }}*</label>
                <input type="text" id="department" name="department" class="form-control" value="{{ old('department', isset($patient) ? $patient->department : '') }}" required>
                @if($errors->has('department'))
                    <p class="help-block">
                        {{ $errors->first('department') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.department_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('designation') ? 'has-error' : '' }}">
                <label for="designation">{{ trans('cruds.patient.fields.designation') }}*</label>
                <input type="text" id="designation" name="designation" class="form-control" value="{{ old('designation', isset($patient) ? $patient->designation : '') }}" required>
                @if($errors->has('designation'))
                    <p class="help-block">
                        {{ $errors->first('designation') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.designation_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                <label for="photo">{{ trans('cruds.patient.fields.photo') }}</label>
                <div class="needsclick dropzone" id="photo-dropzone">

                </div>
                @if($errors->has('photo'))
                    <p class="help-block">
                        {{ $errors->first('photo') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.photo_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
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
}
</script>
@stop