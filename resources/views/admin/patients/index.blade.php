@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.patients.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Patient">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.pin_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.blood_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.dob') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.office') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.job_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.designation') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.updated_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.deleted_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $key => $patient)
                        <tr data-entry-id="{{ $patient->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $patient->id ?? '' }}
                            </td>
                            <td>
                                {{ $patient->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->pin_code ?? '' }}
                            </td>
                            <td>
                                {{ $patient->phone ?? '' }}
                            </td>
                            <td>
                                {{ App\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->address ?? '' }}
                            </td>
                            <td>
                                {{ $patient->email ?? '' }}
                            </td>
                            <td>
                                {{ App\Patient::BLOOD_GROUP_SELECT[$patient->blood_group] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->dob ?? '' }}
                            </td>
                            <td>
                                {{ App\Patient::OFFICE_SELECT[$patient->office] ?? '' }}
                            </td>
                            <td>
                                {{ App\Patient::JOB_TYPE_SELECT[$patient->job_type] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->department ?? '' }}
                            </td>
                            <td>
                                {{ $patient->designation ?? '' }}
                            </td>
                            <td>
                                @if($patient->photo)
                                    <a href="{{ $patient->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $patient->photo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $patient->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $patient->updated_at ?? '' }}
                            </td>
                            <td>
                                {{ $patient->deleted_at ?? '' }}
                            </td>
                            <td>
                                @can('patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.patients.show', $patient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.patients.edit', $patient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_delete')
                                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patients.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Patient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection