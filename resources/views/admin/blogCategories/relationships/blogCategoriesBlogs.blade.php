<div class="content">
    @can('blog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.blogs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.blog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.blog.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-blogCategoriesBlogs">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.is_featured') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.is_premium') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.blog_categories') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.post_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.format') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.blog.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $key => $blog)
                                    <tr data-entry-id="{{ $blog->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $blog->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $blog->is_featured ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $blog->is_featured ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $blog->is_premium ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $blog->is_premium ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $blog->blog_categories->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blog->post_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Blog::STATUS_SELECT[$blog->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Blog::FORMAT_SELECT[$blog->format] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blog->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $blog->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('blog_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.blogs.show', $blog->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('blog_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.blogs.edit', $blog->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('blog_delete')
                                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('blog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.blogs.massDestroy') }}",
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
  let table = $('.datatable-blogCategoriesBlogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection