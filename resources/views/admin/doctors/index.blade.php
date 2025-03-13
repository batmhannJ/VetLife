@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.doctor.title_singular') }} {{ trans('global.list') }}
        @can('doctor_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route("admin.doctors.create") }}">
                        {{ trans('global.add') }} {{ trans('cruds.doctor.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Doctor">
                <thead>
                    <tr>
                        <th width="10">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>{{ trans('cruds.doctor.fields.id') }}</th>
                        <th>{{ trans('cruds.doctor.fields.name') }}</th>
                        <th>{{ trans('cruds.doctor.fields.specialist') }}</th>
                        <th>{{ trans('cruds.doctor.fields.degree') }}</th>
                        <th>{{ trans('cruds.doctor.fields.department') }}</th>
                        <th>{{ trans('cruds.doctor.fields.experience') }}</th>
                        <th>{{ trans('cruds.doctor.fields.service_place') }}</th>
                        <th>{{ trans('cruds.doctor.fields.phone') }}</th>
                        <th>{{ trans('cruds.doctor.fields.email') }}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $key => $doctor)
                        <tr data-entry-id="{{ $doctor->id }}">
                            <td>
                                <input type="checkbox" class="select-checkbox" value="{{ $doctor->id }}">
                            </td>
                            <td>{{ $doctor->id ?? '' }}</td>
                            <td>{{ $doctor->name ?? '' }}</td>
                            <td>{{ $doctor->specialist ?? '' }}</td>
                            <td>{{ $doctor->degree ?? '' }}</td>
                            <td>{{ $doctor->department ?? '' }}</td>
                            <td>{{ $doctor->experience ?? '' }}</td>
                            <td>{{ $doctor->service_place ?? '' }}</td>
                            <td>{{ $doctor->phone ?? '' }}</td>
                            <td>{{ $doctor->email ?? '' }}</td>
                            <td>
                                @can('doctor_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.doctors.show', $doctor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('doctor_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.doctors.edit', $doctor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('doctor_delete')
                                    <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        // Define _token variable if not already defined
        var _token = $('meta[name="csrf-token"]').attr('content');
        
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons || [])
        
        @can('doctor_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.doctors.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan
        
        // Initialize DataTable with fixed options
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: false,
            retrieve: true,
            aaSorting: [],
            dom: 'Bfrtip',
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [[ 1, 'desc' ]],
            pageLength: 100,
            scrollX: true,
            scrollCollapse: true,
            columnDefs: [
                { width: '150px', targets: '_all' },
            ],
            fixedColumns: true
        };
        
        // Create DataTable
        let table = $('.datatable-Doctor').DataTable(dtOverrideGlobals);
        
        // Select all/none
        $('#select-all').on('click', function() {
            let rows = table.rows().nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            if (this.checked) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
        });
        
        // Adjust columns on window resize
        $(window).on('resize', function () {
            table.columns.adjust();
        });
        
        // Adjust columns when switching tabs
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust();
        });
        
        // Make sure columns are properly sized after initialization
        setTimeout(function() {
            table.columns.adjust();
        }, 300);
    });
</script>
@endsection