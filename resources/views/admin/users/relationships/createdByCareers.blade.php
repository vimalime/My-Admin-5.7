<div class="content">
    @can('career_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.careers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.career.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.career.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-createdByCareers">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.career.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.career.fields.publish_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.career.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.career.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.career.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($careers as $key => $career)
                                    <tr data-entry-id="{{ $career->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $career->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $career->publish_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Career::STATUS_SELECT[$career->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $career->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $career->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('career_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.careers.show', $career->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('career_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.careers.edit', $career->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('career_delete')
                                                <form action="{{ route('admin.careers.destroy', $career->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('career_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.careers.massDestroy') }}",
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
  let table = $('.datatable-createdByCareers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection