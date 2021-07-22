@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('blog_category_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.blog-categories.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.blogCategory.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'BlogCategory', 'route' => 'admin.blog-categories.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.blogCategory.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BlogCategory">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.parent') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blogCategory.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogCategories as $key => $blogCategory)
                                    <tr data-entry-id="{{ $blogCategory->id }}">
                                        <td>
                                            {{ $blogCategory->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogCategory->parent->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\BlogCategory::STATUS_SELECT[$blogCategory->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogCategory->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blogCategory->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('blog_category_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.blog-categories.show', $blogCategory->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('blog_category_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.blog-categories.edit', $blogCategory->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('blog_category_delete')
                                                <form action="{{ route('frontend.blog-categories.destroy', $blogCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('blog_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.blog-categories.massDestroy') }}",
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
  let table = $('.datatable-BlogCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection