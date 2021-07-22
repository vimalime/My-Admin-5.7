<div class="content">
    @can('page_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.pages.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.page.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.page.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-createdByPages">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.page.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.page.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.page.fields.template') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.page.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.page.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $key => $page)
                                    <tr data-entry-id="{{ $page->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $page->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Page::STATUS_SELECT[$page->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $page->template->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $page->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $page->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('page_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.pages.show', $page->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('page_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.pages.edit', $page->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('page_delete')
                                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pages.massDestroy') }}",
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
  let table = $('.datatable-createdByPages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection