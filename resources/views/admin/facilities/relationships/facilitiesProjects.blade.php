<div class="content">
    @can('project_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-facilitiesProjects">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.is_featured') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.is_premium') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $key => $project)
                                    <tr data-entry-id="{{ $project->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $project->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Project::TYPE_SELECT[$project->type] ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $project->is_featured ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $project->is_featured ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $project->is_premium ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $project->is_premium ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $project->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $project->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('project_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('project_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('project_delete')
                                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-facilitiesProjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection