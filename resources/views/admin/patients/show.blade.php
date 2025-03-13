@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.first_name') }}
                        </th>
                        <td>
                            {{ $patient->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.last_name') }}
                        </th>
                        <td>
                            {{ $patient->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.pin_code') }}
                        </th>
                        <td>
                            {{ $patient->pin_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <td>
                            {{ $patient->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <td>
                            {{ $patient->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <td>
                            {{ $patient->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.blood_group') }}
                        </th>
                        <td>
                            {{ App\Patient::BLOOD_GROUP_SELECT[$patient->blood_group] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.dob') }}
                        </th>
                        <td>
                            {{ $patient->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.emergency_contact_name') }}
                        </th>
                        <td>
                            {{ $patient->emergency_contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.emergency_contact_relationship') }}
                        </th>
                        <td>
                            {{ $patient->emergency_contact_relationship }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.emergency_contact_phone') }}
                        </th>
                        <td>
                            {{ $patient->emergency_contact_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.emergency_contact_address') }}
                        </th>
                        <td>
                            {{ $patient->emergency_contact_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.created_at') }}
                        </th>
                        <td>
                            {{ $patient->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $patient->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection