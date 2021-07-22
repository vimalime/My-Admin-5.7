@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.facility.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.facilities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $facility->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $facility->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $facility->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.icon') }}
                                    </th>
                                    <td>
                                        {{ $facility->icon }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $facility->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $facility->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facility.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $facility->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.facilities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#facilities_properties" aria-controls="facilities_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#facilities_projects" aria-controls="facilities_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="facilities_properties">
                        @includeIf('admin.facilities.relationships.facilitiesProperties', ['properties' => $facility->facilitiesProperties])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="facilities_projects">
                        @includeIf('admin.facilities.relationships.facilitiesProjects', ['projects' => $facility->facilitiesProjects])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection