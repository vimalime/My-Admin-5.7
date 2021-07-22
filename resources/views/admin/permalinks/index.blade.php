@extends('layouts.admin')
@section('content')
<div class="content">
    @can('permalink_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.permalinks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.permalink.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.permalink.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Permalink">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.pages') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_posts') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_categories') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.blog_tags') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.careers') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_properties') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_property_categories') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.permalink.fields.real_estate_projects') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permalinks as $key => $permalink)
                                    <tr data-entry-id="{{ $permalink->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $permalink->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->pages ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->blog_posts ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->blog_categories ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->blog_tags ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->careers ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->real_estate_properties ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->real_estate_property_categories ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permalink->real_estate_projects ?? '' }}
                                        </td>
                                        <td>
                                            @can('permalink_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.permalinks.show', $permalink->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('permalink_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.permalinks.edit', $permalink->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('permalink_delete')
                                                <form action="{{ route('admin.permalinks.destroy', $permalink->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('permalink_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.permalinks.massDestroy') }}",
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
  let table = $('.datatable-Permalink:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection