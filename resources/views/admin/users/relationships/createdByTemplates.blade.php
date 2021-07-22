<div class="content">
    @can('template_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.templates.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.template.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.template.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-createdByTemplates">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.template.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.template.fields.slug') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.template.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.template.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.template.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $key => $template)
                                    <tr data-entry-id="{{ $template->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $template->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $template->slug ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Template::STATUS_SELECT[$template->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $template->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $template->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('template_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.templates.show', $template->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('template_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.templates.edit', $template->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('template_delete')
                                                <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('template_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.templates.massDestroy') }}",
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
  let table = $('.datatable-createdByTemplates:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection