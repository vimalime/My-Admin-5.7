@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.city.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $city->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $city->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $city->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $city->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $city->state->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $city->order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\City::STATUS_SELECT[$city->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $city->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $city->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $city->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
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
                        <a href="#city_users" aria-controls="city_users" role="tab" data-toggle="tab">
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#city_projects" aria-controls="city_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#city_properties" aria-controls="city_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="city_users">
                        @includeIf('admin.cities.relationships.cityUsers', ['users' => $city->cityUsers])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="city_projects">
                        @includeIf('admin.cities.relationships.cityProjects', ['projects' => $city->cityProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="city_properties">
                        @includeIf('admin.cities.relationships.cityProperties', ['properties' => $city->cityProperties])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection