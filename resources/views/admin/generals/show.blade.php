@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.general.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.generals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $general->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.admin_email') }}
                                    </th>
                                    <td>
                                        {{ $general->admin_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.timezone') }}
                                    </th>
                                    <td>
                                        {{ $general->timezone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.admin_logo') }}
                                    </th>
                                    <td>
                                        @if($general->admin_logo)
                                            <a href="{{ $general->admin_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $general->admin_logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.admin_favicon') }}
                                    </th>
                                    <td>
                                        @if($general->admin_favicon)
                                            <a href="{{ $general->admin_favicon->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $general->admin_favicon->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.background_image') }}
                                    </th>
                                    <td>
                                        @if($general->background_image)
                                            <a href="{{ $general->background_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $general->background_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.admin_title') }}
                                    </th>
                                    <td>
                                        {{ $general->admin_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.google_site_verification') }}
                                    </th>
                                    <td>
                                        {{ $general->google_site_verification }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.google_analytics') }}
                                    </th>
                                    <td>
                                        {{ $general->google_analytics }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.general.fields.analytics_view') }}
                                    </th>
                                    <td>
                                        {{ $general->analytics_view }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.generals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection