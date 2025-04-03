@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.services.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.name') }}
                        </th>
                        <td>
                            {{ $service->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.animal_type') }}
                        </th>
                        <td>
                            {{ $service->animal_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.description') }}
                        </th>
                        <td>
                            {{ $service->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.price') }}
                        </th>
                        <td>
                            {{ $service->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.active') }}
                        </th>
                        <td>
                            {{ $service->active }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.created_at') }}
                        </th>
                        <td>
                            {{ $service->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.services.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $service->updated_at }}
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