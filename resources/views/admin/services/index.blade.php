@extends('layouts.admin')
@section('content')
@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.services.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.services.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.services.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            
    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('admin.services.index') }}" class="mb-3">
        <label for="animal_type">Filter by Animal Type:</label>
        <select name="animal_type" id="animal_type" class="entries-select" onchange="this.form.submit()">
            <option value="">All</option>
            @foreach($animalTypes as $type)
                <option value="{{ $type->animal_type }}" {{ request('animal_type') == $type->animal_type ? 'selected' : '' }}>
                    {{ $type->animal_type }}
                </option>
            @endforeach
        </select>
    </form>
            <table class=" table table-bordered table-striped table-hover datatable datatable-Patient">
                <thead>
                                <tr>
                                <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <span>Date Created</span>
                                            <span class="sort-icon ml-1">⬍</span>
                                        </div>
                                    </th>
                                    <th>Service</th>
                                    <th>For</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $index => $service)
                                <tr data-entry-id="{{ $service->id }}">
                                    <td>
                                    </td>    
                                    <td>
                                        {{ $service->id ?? '' }}
                                    </td>
                                    <td>{{ $service->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->animal_type }}</td>
                                    <td>{{ number_format($service->price, 2) }}</td>
                                    <td>
                                @can('patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.services.show', $service->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.services.edit', $service->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_delete')
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No services found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('service_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.services.massDestroy') }}",
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