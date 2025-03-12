@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicine.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.id') }}
                        </th>
                        <td>
                            {{ $medicine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.item_code') }}
                        </th>
                        <td>
                            {{ $medicine->item_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.name') }}
                        </th>
                        <td>
                            {{ $medicine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.generic_name') }}
                        </th>
                        <td>
                            {{ $medicine->generic_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.type') }}
                        </th>
                        <td>
                            {{ App\Medicine::TYPE_SELECT[$medicine->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.uos') }}
                        </th>
                        <td>
                            {{ $medicine->uos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.received_from') }}
                        </th>
                        <td>
                            {{ $medicine->received_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.qty_received') }}
                        </th>
                        <td>
                            {{ $medicine->qty_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.date_received') }}
                        </th>
                        <td>
                            {{ $medicine->date_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $medicine->expiry_date }}
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