<div class="content">
    @can('property_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.properties.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.property.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.property.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-propertyTypeProperties">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.is_featured') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.is_premium') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.moderation_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.selling_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.created_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.property.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $key => $property)
                                    <tr data-entry-id="{{ $property->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $property->title ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $property->is_featured ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $property->is_featured ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $property->is_premium ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $property->is_premium ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ App\Models\Property::MODERATION_STATUS_SELECT[$property->moderation_status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Property::STATUS_SELECT[$property->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Property::SELLING_STATUS_SELECT[$property->selling_status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $property->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $property->created_by->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $property->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('property_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.properties.show', $property->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('property_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.properties.edit', $property->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('property_delete')
                                                <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('property_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.properties.massDestroy') }}",
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
  let table = $('.datatable-propertyTypeProperties:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection