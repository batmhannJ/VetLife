@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prescription.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.prescriptions.update", [$prescription->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('patients') ? 'has-error' : '' }}">
                <label for="patient">{{ trans('cruds.prescription.fields.patient') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="patients[]" id="patients" class="form-control select2" multiple="multiple" required>
                    @foreach($patients as $id => $patient)
                        <option value="{{ $id }}" {{ (in_array($id, old('patients', [])) || isset($prescription) && $prescription->patients->contains($id)) ? 'selected' : '' }}>{{ $patient }}</option>
                    @endforeach
                </select>
                @if($errors->has('patients'))
                    <p class="help-block">
                        {{ $errors->first('patients') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.prescription.fields.patient_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('drug_id') ? 'has-error' : '' }}">
                <label for="drug">{{ trans('cruds.prescription.fields.drug') }}*</label>
                <select name="drug_id" id="drug" class="form-control select2" required>
                    @foreach($drugs as $id => $drug)
                        <option value="{{ $id }}" {{ (isset($prescription) && $prescription->drug ? $prescription->drug->id : old('drug_id')) == $id ? 'selected' : '' }}>{{ $drug }}</option>
                    @endforeach
                </select>
                @if($errors->has('drug_id'))
                    <p class="help-block">
                        {{ $errors->first('drug_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('quantity_issued') ? 'has-error' : '' }}">
                <label for="quantity_issued">{{ trans('cruds.prescription.fields.quantity_issued') }}*</label>
                <input type="number" id="quantity_issued" name="quantity_issued" class="form-control" value="{{ old('quantity_issued', isset($prescription) ? $prescription->quantity_issued : '') }}" step="1" required>
                @if($errors->has('quantity_issued'))
                    <p class="help-block">
                        {{ $errors->first('quantity_issued') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.prescription.fields.quantity_issued_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('date_issued') ? 'has-error' : '' }}">
                <label for="date_issued">{{ trans('cruds.prescription.fields.date_issued') }}*</label>
                <input type="text" id="date_issued" name="date_issued" class="form-control date" value="{{ old('date_issued', isset($prescription) ? $prescription->date_issued : '') }}" required>
                @if($errors->has('date_issued'))
                    <p class="help-block">
                        {{ $errors->first('date_issued') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.prescription.fields.date_issued_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection