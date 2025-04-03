@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.categories.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="animal_type">{{ trans('cruds.categories.fields.animal_type') }}</label>
                <input class="form-control {{ $errors->has('animal_type') ? 'is-invalid' : '' }}" type="text" name="animal_type" id="animal_type" value="{{ old('animal_type', $category->animal_type) }}" required>
                @if($errors->has('animal_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('animal_type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.categories.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $category->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection