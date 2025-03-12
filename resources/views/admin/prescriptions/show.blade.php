@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prescription.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.id') }}
                        </th>
                        <td>
                            {{ $prescription->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Patient
                        </th>
                        <td>
                            @foreach($prescription->patients as $id => $patient)
                                <span class="label label-info label-many">{{ $patient->pin_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.drug') }}
                        </th>
                        <td>
                            {{ $prescription->drug->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.quantity_issued') }}
                        </th>
                        <td>
                            {{ $prescription->quantity_issued }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.date_issued') }}
                        </th>
                        <td>
                            {{ $prescription->date_issued }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.created_at') }}
                        </th>
                        <td>
                            {{ $prescription->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $prescription->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prescription.fields.deleted_at') }}
                        </th>
                        <td>
                            {{ $prescription->deleted_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection