@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('property_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.property-types.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.propertyType.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.propertyType.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PropertyType">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.propertyType.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($propertyTypes as $key => $propertyType)
                                    <tr data-entry-id="{{ $propertyType->id }}">
                                        <td>
                                            {{ $propertyType->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PropertyType::STATUS_SELECT[$propertyType->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $propertyType->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $propertyType->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('property_type_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.property-types.show', $propertyType->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('property_type_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.property-types.edit', $propertyType->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('property_type_delete')
                                                <form action="{{ route('frontend.property-types.destroy', $propertyType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('property_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.property-types.massDestroy') }}",
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
  let table = $('.datatable-PropertyType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection