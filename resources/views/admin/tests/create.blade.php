@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.test.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tests.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('patients') ? 'has-error' : '' }}">
                <label for="patient">{{ trans('cruds.test.fields.patient') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="patients[]" id="patients" class="form-control select2" multiple="multiple">
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ (in_array($id, old('patients', [])) || isset($test) && $test->patients->contains($id)) ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patients'))
                    <p class="help-block">
                        {{ $errors->first('patients') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.test.fields.patient_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('rdt') ? 'has-error' : '' }}">
                <label for="rdt">{{ trans('cruds.test.fields.rdt') }}</label>
                <select id="rdt" name="rdt" class="form-control">
                    <option value="" disabled {{ old('rdt', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Test::RDT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rdt', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('rdt'))
                    <p class="help-block">
                        {{ $errors->first('rdt') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('blood_pressure') ? 'has-error' : '' }}">
                <label for="blood_pressure">{{ trans('cruds.test.fields.blood_pressure') }}</label>
                <input type="text" id="blood_pressure" name="blood_pressure" class="form-control" value="{{ old('blood_pressure', isset($test) ? $test->blood_pressure : '') }}">
                @if($errors->has('blood_pressure'))
                    <p class="help-block">
                        {{ $errors->first('blood_pressure') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.test.fields.blood_pressure_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('heart_rate') ? 'has-error' : '' }}">
                <label for="heart_rate">{{ trans('cruds.test.fields.heart_rate') }}</label>
                <input type="text" id="heart_rate" name="heart_rate" class="form-control" value="{{ old('heart_rate', isset($test) ? $test->heart_rate : '') }}">
                @if($errors->has('heart_rate'))
                    <p class="help-block">
                        {{ $errors->first('heart_rate') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.test.fields.heart_rate_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection