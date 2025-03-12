@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.doctors.storeMedia') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('cruds.doctor.fields.first_name') }}*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($doctor) ? $doctor->first_name : '') }}" required>
                @if($errors->has('first_name'))
                    <p class="help-block">
                        {{ $errors->first('first_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.first_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('cruds.doctor.fields.last_name') }}*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($doctor) ? $doctor->last_name : '') }}" required>
                @if($errors->has('last_name'))
                    <p class="help-block">
                        {{ $errors->first('last_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.last_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
                <label for="specialization">{{ trans('cruds.doctor.fields.specialization') }}*</label>
                <input type="text" id="specialization" name="specialization" class="form-control" value="{{ old('specialization', isset($doctor) ? $doctor->specialization : '') }}" required>
                @if($errors->has('specialization'))
                    <p class="help-block">
                        {{ $errors->first('specialization') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.specialization_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($doctor) ? $doctor->phone : '') }}">
                @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('phone') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($doctor) ? $doctor->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('cruds.doctor.fields.address') }}*</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($doctor) ? $doctor->address : '') }}" required>
                @if($errors->has('address'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.address_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                <label for="photo">{{ trans('cruds.doctor.fields.photo') }}</label>
                <div class="needsclick dropzone" id="photo-dropzone">

                </div>
                @if($errors->has('photo'))
                    <p class="help-block">
                        {{ $errors->first('photo') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.doctor.fields.photo_helper') }}
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
    url: '{{ route('admin.doctors.storeMedia') }}',
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
@if(isset($doctor) && $doctor->photo)
      var file = {!! json_encode($doctor->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $doctor->photo->getUrl('thumb') }}')
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
@endsection