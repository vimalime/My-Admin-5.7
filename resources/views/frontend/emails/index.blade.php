@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('email_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.emails.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.email.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.email.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Email">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.email.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.email.fields.email_driver') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.email.fields.email_mail_gun_domain') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.email.fields.email_mail_gun_endpoint') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.email.fields.email_from_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.email.fields.email_from_address') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emails as $key => $email)
                                    <tr data-entry-id="{{ $email->id }}">
                                        <td>
                                            {{ $email->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $email->email_driver ?? '' }}
                                        </td>
                                        <td>
                                            {{ $email->email_mail_gun_domain ?? '' }}
                                        </td>
                                        <td>
                                            {{ $email->email_mail_gun_endpoint ?? '' }}
                                        </td>
                                        <td>
                                            {{ $email->email_from_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $email->email_from_address ?? '' }}
                                        </td>
                                        <td>
                                            @can('email_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.emails.show', $email->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('email_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.emails.edit', $email->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('email_delete')
                                                <form action="{{ route('frontend.emails.destroy', $email->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('email_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.emails.massDestroy') }}",
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
  let table = $('.datatable-Email:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection