@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.test.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.id') }}
                        </th>
                        <td>
                            {{ $test->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Patient
                        </th>
                        <td>
                            @foreach($test->patients as $id => $patient)
                                <span class="label label-info label-many">{{ $patient->pin_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.rdt') }}
                        </th>
                        <td>
                            {{ App\Test::RDT_SELECT[$test->rdt] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.blood_pressure') }}
                        </th>
                        <td>
                            {{ $test->blood_pressure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.heart_rate') }}
                        </th>
                        <td>
                            {{ $test->heart_rate }}
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