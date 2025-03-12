@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.medicine.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.medicines.update", [$medicine->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('item_code') ? 'has-error' : '' }}">
                <label for="item_code">{{ trans('cruds.medicine.fields.item_code') }}*</label>
                <input type="text" id="item_code" name="item_code" class="form-control" value="{{ old('item_code', isset($medicine) ? $medicine->item_code : '') }}" required>
                @if($errors->has('item_code'))
                    <p class="help-block">
                        {{ $errors->first('item_code') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.item_code_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.medicine.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($medicine) ? $medicine->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('generic_name') ? 'has-error' : '' }}">
                <label for="generic_name">{{ trans('cruds.medicine.fields.generic_name') }}</label>
                <input type="text" id="generic_name" name="generic_name" class="form-control" value="{{ old('generic_name', isset($medicine) ? $medicine->generic_name : '') }}">
                @if($errors->has('generic_name'))
                    <p class="help-block">
                        {{ $errors->first('generic_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.generic_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                <label for="type">{{ trans('cruds.medicine.fields.type') }}*</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="" disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Medicine::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $medicine->type) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <p class="help-block">
                        {{ $errors->first('type') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('uos') ? 'has-error' : '' }}">
                <label for="uos">{{ trans('cruds.medicine.fields.uos') }}*</label>
                <input type="text" id="uos" name="uos" class="form-control" value="{{ old('uos', isset($medicine) ? $medicine->uos : '') }}" required>
                @if($errors->has('uos'))
                    <p class="help-block">
                        {{ $errors->first('uos') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.uos_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('received_from') ? 'has-error' : '' }}">
                <label for="received_from">{{ trans('cruds.medicine.fields.received_from') }}*</label>
                <input type="text" id="received_from" name="received_from" class="form-control" value="{{ old('received_from', isset($medicine) ? $medicine->received_from : '') }}" required>
                @if($errors->has('received_from'))
                    <p class="help-block">
                        {{ $errors->first('received_from') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.received_from_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('qty_received') ? 'has-error' : '' }}">
                <label for="qty_received">{{ trans('cruds.medicine.fields.qty_received') }}</label>
                <input type="number" id="qty_received" name="qty_received" class="form-control" value="{{ old('qty_received', isset($medicine) ? $medicine->qty_received : '') }}" step="1">
                @if($errors->has('qty_received'))
                    <p class="help-block">
                        {{ $errors->first('qty_received') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.qty_received_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('date_received') ? 'has-error' : '' }}">
                <label for="date_received">{{ trans('cruds.medicine.fields.date_received') }}*</label>
                <input type="text" id="date_received" name="date_received" class="form-control datetime" value="{{ old('date_received', isset($medicine) ? $medicine->date_received : '') }}" required>
                @if($errors->has('date_received'))
                    <p class="help-block">
                        {{ $errors->first('date_received') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.date_received_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('expiry_date') ? 'has-error' : '' }}">
                <label for="expiry_date">{{ trans('cruds.medicine.fields.expiry_date') }}*</label>
                <input type="text" id="expiry_date" name="expiry_date" class="form-control date" value="{{ old('expiry_date', isset($medicine) ? $medicine->expiry_date : '') }}" required>
                @if($errors->has('expiry_date'))
                    <p class="help-block">
                        {{ $errors->first('expiry_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.medicine.fields.expiry_date_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection