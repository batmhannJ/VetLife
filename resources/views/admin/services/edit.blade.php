@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.services.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.services.update", [$service->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('cruds.services.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($service) ? $service->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.first_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('animal_type') ? 'has-error' : '' }}">
                <label for="animal_type">{{ trans('cruds.services.fields.animal_type') }}*</label>
                <input type="text" id="animal_type" name="animal_type" class="form-control" value="{{ old('animal_type', isset($service) ? $service->animal_type : '') }}" required>
                @if($errors->has('animal_type'))
                    <p class="help-block">
                        {{ $errors->first('animal_type') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.last_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.services.fields.description') }}*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($service) ? $service->description : '') }}" required>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.pin_code_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('cruds.services.fields.price') }}</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($service) ? $service->price : '') }}" step="1">
                @if($errors->has('price'))
                    <p class="help-block">
                        {{ $errors->first('price') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.patient.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                <label for="active">{{ trans('cruds.services.fields.active') }}*</label>
                <select id="active" name="active" class="form-control" required>
                    <option value="1" {{ old('active', isset($service) ? $service->active : '') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('active', isset($service) ? $service->active : '') == 0 ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
