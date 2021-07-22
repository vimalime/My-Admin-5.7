@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.country.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $country->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $country->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.short_code') }}
                                    </th>
                                    <td>
                                        {{ $country->short_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $country->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $country->order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Country::STATUS_SELECT[$country->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $country->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $country->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $country->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
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
                        <a href="#country_states" aria-controls="country_states" role="tab" data-toggle="tab">
                            {{ trans('cruds.state.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_cities" aria-controls="country_cities" role="tab" data-toggle="tab">
                            {{ trans('cruds.city.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_users" aria-controls="country_users" role="tab" data-toggle="tab">
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_projects" aria-controls="country_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_properties" aria-controls="country_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="country_states">
                        @includeIf('admin.countries.relationships.countryStates', ['states' => $country->countryStates])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_cities">
                        @includeIf('admin.countries.relationships.countryCities', ['cities' => $country->countryCities])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_users">
                        @includeIf('admin.countries.relationships.countryUsers', ['users' => $country->countryUsers])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_projects">
                        @includeIf('admin.countries.relationships.countryProjects', ['projects' => $country->countryProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_properties">
                        @includeIf('admin.countries.relationships.countryProperties', ['properties' => $country->countryProperties])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection