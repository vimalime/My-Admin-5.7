<div class="content">
    @can('package_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.packages.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.package.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.package.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-createdByPackages">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.is_featured') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.is_premium') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.post_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.publish_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.package.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $key => $package)
                                    <tr data-entry-id="{{ $package->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $package->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $package->is_featured ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $package->is_featured ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $package->is_premium ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $package->is_premium ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ App\Models\Package::POST_STATUS_SELECT[$package->post_status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $package->publish_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $package->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $package->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('package_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.packages.show', $package->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('package_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.packages.edit', $package->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('package_delete')
                                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('package_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.packages.massDestroy') }}",
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
  let table = $('.datatable-createdByPackages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection